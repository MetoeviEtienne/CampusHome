<?php

namespace App\Http\Controllers\Etudiant;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Logement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NouvelleReservation;
use Illuminate\Support\Carbon;

class ReservationController extends Controller
{
    /**
     * Enregistrer une réservation pour un logement.
     */
    public function store(Request $request, Logement $logement)
    {
        $validated = $request->validate([
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin' => 'required|date|after:date_debut',
            'universite' => 'required|string|max:255',
            'autre_universite' => 'nullable|string|max:255',
            'inscription_pdf' => 'required|mimes:pdf|max:2048', // max 2Mo
        ]);
        //  // Ensuite, on calcule la date max autorisée
        // $dateDebut = Carbon::parse($request->date_debut);
        // $dateFinMax = $dateDebut->copy()->addDays(5)->toDateString();

        // // Et on valide date_fin
        // $request->validate([
        //     'date_fin' => [
        //         'required',
        //         'date',
        //         'after_or_equal:' . $dateDebut->toDateString(),
        //         'before_or_equal:' . $dateFinMax,
        //     ],
        // ]);
        
    // Si l'étudiant a sélectionné "Autre", on utilise le champ texte
    $universite = $validated['universite'] === 'Autre' && !empty($request->autre_universite)
        ? $request->autre_universite
        : $validated['universite'];

        // Vérifier si logement déjà réservé pour la période demandée
        $exists = Reservation::where('logement_id', $logement->id)
            ->where('statut', 'approuvee')
            ->where(function ($query) use ($validated) {
                $query->whereBetween('date_debut', [$validated['date_debut'], $validated['date_fin']])
                      ->orWhereBetween('date_fin', [$validated['date_debut'], $validated['date_fin']])
                      ->orWhere(function ($q) use ($validated) {
                          $q->where('date_debut', '<=', $validated['date_debut'])
                            ->where('date_fin', '>=', $validated['date_fin']);
                      });
            })
            ->exists();

        if ($exists) {
            return redirect()->back()->withErrors(['logement' => 'Ce logement est déjà réservé pour cette période.']);
        }

        if ($request->hasFile('inscription_pdf')) {
        $pdfPath = $request->file('inscription_pdf')->store('inscriptions_pdf', 'public');
        } else {
            $pdfPath = null;
        }
        // Création de la réservation
        $reservation = Reservation::create([
            'etudiant_id' => Auth::id(),
            'logement_id' => $logement->id,
            'date_debut' => $validated['date_debut'],
            'date_fin' => $validated['date_fin'],
            'universite' => $validated['universite'],
            'inscription_pdf' => $pdfPath,
            // 'inscription_pdf' => $validated['inscription_pdf'],
            'statut' => 'en_attente',
        ]);

        // Envoi de la notification au propriétaire
        $proprietaire = $logement->proprietaire;
        if ($proprietaire) {
            $proprietaire->notify(new NouvelleReservation($reservation));
        }

        return redirect()->back()->with('success', 'Réservation enregistrée avec succès.');
    }

    /**
     * Afficher toutes les réservations de l'étudiant connecté.
     */
    // public function index()
    // {
    //     $reservations = Auth::user()->reservations()->with('logement')->latest()->get();
    //     return view('etudiants.reservations.index', compact('reservations'));
    // }

    public function index()
    {
        $reservations = Auth::user()
            ->reservations()
            ->with(['logement', 'paiements']) // 👈 On charge aussi les paiements
            ->latest()
            ->get();

        return view('etudiants.reservations.index', compact('reservations'));
    }

    /**
     * Télécharger le contrat d'une réservation.
     */
    public function contrat(Reservation $reservation)
    {
        abort_unless($reservation->etudiant_id === Auth::id(), 403);

        if (!$reservation->contrat) {
            abort(404);
        }

        return response()->file(storage_path("app/public/{$reservation->contrat}"));
    }

    /**
     * Afficher le formulaire de réservation d’un logement.
     */
    public function create(Logement $logement)
    {
        return view('etudiants.reservations.create', compact('logement'));
    }

    /**
     * Supprimer une réservation (si autorisé).
     */
    public function destroy(Reservation $reservation)
    {
        if ($reservation->etudiant_id !== Auth::id()) {
            abort(403);
        }

        if ($reservation->statut === 'approuvee' && $reservation->contrat) {
            return redirect()->back()->with('error', 'Vous ne pouvez pas supprimer une réservation approuvée avec contrat.');
        }

        $reservation->delete();

        return redirect()->back()->with('success', 'Réservation supprimée avec succès.');
    }
}
