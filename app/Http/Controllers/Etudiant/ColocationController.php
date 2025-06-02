<?php

namespace App\Http\Controllers\Etudiant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Colocation; 

class ColocationController extends Controller
{
   public function create($reservationId)
    {
        $reservation = Reservation::findOrFail($reservationId);

        // Vérification de l'étudiant propriétaire
        if ($reservation->etudiant_id !== auth()->id()) {
            abort(403);
        }

        return view('etudiants.colocations.create', compact('reservation'));
    }

    // methode pour la sauvegarde des annonces
    public function store(Request $request, $reservationId)
    {
        $reservation = Reservation::findOrFail($reservationId);

        // Vérification que l'étudiant est bien le propriétaire de la réservation
        if ($reservation->etudiant_id !== auth()->id()) {
            abort(403);
        }

        // Vérifier si l'étudiant a déjà publié 2 annonces
        $colocationsCount = Colocation::whereHas('reservation', function ($query) {
            $query->where('etudiant_id', auth()->id());
        })->count();

        if ($colocationsCount >= 2) {
            return redirect()->back()->withErrors(['limit' => 'Vous avez déjà publié 2 annonces de colocation.']);
        }

        // Validation des données
        $request->validate([
            'description' => 'required|string',
            'nombre_places' => 'required|integer|min:1|max:2',
            'telephone' => 'required|string|size:10',
        ]);

        // Création de l’annonce
        Colocation::create([
            'reservation_id' => $reservation->id,
            'description' => $request->description,
            'nombre_places' => $request->nombre_places,
            'telephone' => $request->telephone,
        ]);

        return redirect()->route('etudiant.logements.index')->with('success', 'Annonce de colocation créée.');
    }

    public function index()
    {
        $colocations = Colocation::with(['reservation.logement', 'reservation.etudiant'])
            ->whereHas('reservation', function ($query) {
                $query->where('statut', 'approuvée')
                    ->whereHas('paiements', function ($q) {
                        $q->where('type', 'avance')->where('statut', 'payé');
                    });
            })
            ->latest()
            ->get();

         $nbAnnonces = Colocation::count(); // Récupère le nombre total d'annonces

        return view('etudiants.colocations.index', compact('colocations', 'nbAnnonces'));
    }

    // Supprimer une annonce de colocation
    public function destroy($id)
    {
        $colocation = Colocation::findOrFail($id);

        // Vérifier si l'utilisateur est bien le propriétaire
        if ($colocation->reservation->etudiant_id !== auth()->id()) {
            abort(403);
        }

        $colocation->delete();

        return redirect()->back()->with('success', 'Annonce supprimée avec succès.');
    }

}
