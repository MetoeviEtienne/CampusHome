<?php
namespace App\Http\Controllers\Etudiant;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Logement;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(Request $request, Logement $logement)
    {
        $validated = $request->validate([
            'date_debut' => 'required|date|after:today',
            'date_fin' => 'required|date|after:date_debut',
        ]);

        // ✅ 2. Vérifier si une réservation similaire existe déjà
        $reservationExistante = Reservation::where('etudiant_id', auth()->id())
            ->where('logement_id', $logement->id)
            ->where(function ($query) use ($validated) {
                $query->whereBetween('date_debut', [$validated['date_debut'], $validated['date_fin']])
                    ->orWhereBetween('date_fin', [$validated['date_debut'], $validated['date_fin']])
                    ->orWhere(function ($query) use ($validated) {
                        $query->where('date_debut', '<=', $validated['date_debut'])
                                ->where('date_fin', '>=', $validated['date_fin']);
                    });
            })
            ->exists();
                if ($reservationExistante) {
                    return back()->with('error', 'Vous avez déjà réservé ce logement pour une période qui se chevauche.');
                }

        // ✅ 3. Vérifier si le logement est déjà réservé pour la période demandée
        $reservation = Reservation::create([
            'etudiant_id' => auth()->id(),
            'logement_id' => $logement->id,
            'date_debut' => $validated['date_debut'],
            'date_fin' => $validated['date_fin'],
            'statut' => 'en_attente',
        ]);

        return redirect()->route('etudiant.reservations.index')
                         ->with('success', 'Demande envoyée avec succès.');
    }

    // Route pour afficher les réservations de l'étudiant
    public function index()
    {
        $reservations = auth()->user()->reservations()->with('logement')->latest()->get();
        return view('etudiants.reservations.index', compact('reservations'));
    }

    // Route pour le téléchargement du contrat
    public function contrat(Reservation $reservation)
    {
        abort_unless($reservation->etudiant_id === auth()->id(), 403);

        if (!$reservation->contrat) {
            abort(404);
        }

        return response()->file(storage_path("app/public/{$reservation->contrat}"));
    }

    // Affiche le formulaire de réservation d’un logement spécifique
    public function create(Logement $logement)
        {
            return view('etudiant.reservations.create', compact('logement'));
        }

    
}
