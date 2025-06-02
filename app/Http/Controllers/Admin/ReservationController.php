<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
   public function index()
    {
        $reservationsParProprietaire = \App\Models\Reservation::with([
            'etudiant', 
            'logement', 
            'logement.proprietaire', 
            'paiements' // charger la relation paiements
        ])
        ->get()
        ->groupBy(fn($reservation) => $reservation->logement->proprietaire->name);

        return view('admin.reservations.index', compact('reservationsParProprietaire'));
    }

    public function approver(Reservation $reservation)
    {
        // Appelle la logique partagée
        return app(\App\Http\Controllers\Shared\ReservationSyncController::class)->approveFromAdmin($reservation);
    }

    public function rejeter(Reservation $reservation)
    {
        return app(\App\Http\Controllers\Shared\ReservationSyncController::class)->rejectFromAdmin($reservation);
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return back()->with('success', 'Réservation supprimée.');
    }
}
