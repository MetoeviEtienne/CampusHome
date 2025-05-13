<?php
namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\Reservation;
use Illuminate\Http\Request;

class AvisController extends Controller
{
    // Méthode pour créer un avis
    public function store(Request $request, $reservation_id)
    {
        // Validation
        $request->validate([
            'note' => 'required|integer|between:1,5',
            'commentaire' => 'required|string|max:255',
        ]);

        // Récupérer la réservation
        $reservation = Reservation::findOrFail($reservation_id);

        // Assurer que l'utilisateur est l'étudiant ayant effectué la réservation
        if ($reservation->etudiant_id != auth()->user()->id) {
            return redirect()->back()->with('error', 'Vous ne pouvez pas laisser un avis pour cette réservation.');
        }

        // Création de l'avis
        Avis::create([
            'auteur_id' => auth()->user()->id,
            'logement_id' => $reservation->logement_id,
            'reservation_id' => $reservation->id,
            'note' => $request->note,
            'commentaire' => $request->commentaire,
        ]);

        return redirect()->route('reservations.index')->with('success', 'Avis soumis avec succès.');
    }
}
