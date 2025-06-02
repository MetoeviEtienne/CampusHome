<?php
namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Notifications\ReservationApproved;
use App\Notifications\ReservationRejected;
use PDF;
use Illuminate\Support\Facades\Storage;

class ReservationSyncController extends Controller
{
    public function approveFromAdmin(Reservation $reservation)
    {
        return $this->approveReservation($reservation);
    }

    public function approveFromProprietaire(Reservation $reservation)
    {
        if ($reservation->logement->proprietaire_id !== auth()->id()) {
            abort(403);
        }

        return $this->approveReservation($reservation);
    }

    private function approveReservation(Reservation $reservation)
    {
        $overlapping = Reservation::where('logement_id', $reservation->logement_id)
            ->where('statut', 'approuvee')
            ->where(function ($query) use ($reservation) {
                $query->whereBetween('date_debut', [$reservation->date_debut, $reservation->date_fin])
                    ->orWhereBetween('date_fin', [$reservation->date_debut, $reservation->date_fin])
                    ->orWhere(function ($q) use ($reservation) {
                        $q->where('date_debut', '<=', $reservation->date_debut)
                          ->where('date_fin', '>=', $reservation->date_fin);
                    });
            })->exists();

        if ($overlapping) {
            return back()->with('error', 'Ce logement est déjà réservé pour cette période.');
        }

        $reservation->update(['statut' => 'approuvee']);

        $pdf = PDF::loadView('contrats.contrat', [
            'reservation' => $reservation,
            'etudiant' => $reservation->etudiant,
            'logement' => $reservation->logement,
        ]);

        $fileName = 'contrats/contrat_' . $reservation->id . '.pdf';
        Storage::disk('public')->put($fileName, $pdf->output());

        $reservation->update(['contrat' => $fileName]);

        $reservation->etudiant->notify(new ReservationApproved($reservation));

        return back()->with('success', 'Réservation approuvée avec succès.');
    }

    public function rejectFromAdmin(Reservation $reservation)
    {
        return $this->rejectReservation($reservation);
    }

    public function rejectFromProprietaire(Reservation $reservation)
    {
        if ($reservation->logement->proprietaire_id !== auth()->id()) {
            abort(403);
        }

        return $this->rejectReservation($reservation);
    }

    private function rejectReservation(Reservation $reservation)
    {
        $reservation->update(['statut' => 'rejetee']);
        $reservation->etudiant->notify(new ReservationRejected($reservation));

        return back()->with('success', 'Réservation rejetée.');
    }
}
