<?php
namespace App\Http\Controllers\Proprietaire;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Notifications\ReservationApproved;
use App\Notifications\ReservationRejected;
use PDF;
use Illuminate\Support\Facades\Storage;


class ReservationController extends Controller
{
    public function index()
    {
        $reservations = auth()->user()->reservations()
            ->with(['logement', 'etudiant'])
            ->latest()
            ->paginate(10);

        return view('proprietaire.reservations.index', compact('reservations'));
    }

    public function approver(Reservation $reservation)
    {
        if ($reservation->logement->proprietaire_id !== auth()->id()) {
            abort(403);
        }

        $reservation->update(['statut' => 'approuvee']);

        // Notification
        $reservation->etudiant->notify(new ReservationApproved($reservation));

        // TODO : génération automatique du contrat

        return back()->with('success', 'Réservation approuvée avec succès.');

        // Génération du contrat PDF
        $pdf = PDF::loadView('contrats.contrat', [
            'reservation' => $reservation,
        ]);

        $filename = 'contrats/contrat_reservation_' . $reservation->id . '.pdf';

        // Enregistrement du PDF dans storage/app/public/contrats/
        Storage::disk('public')->put($filename, $pdf->output());

        // Enregistre le chemin du contrat si tu as une colonne "contrat" dans la table reservations
        $reservation->update([
            'contrat' => $filename,
        ]);

    }

    public function rejeter(Reservation $reservation)
        {
        if ($reservation->logement->proprietaire_id !== auth()->id()) {
            abort(403);
        }

        $reservation->update(['statut' => 'rejetee']);

        // Notification
        $reservation->etudiant->notify(new ReservationRejected($reservation));

        return back()->with('success', 'Réservation rejetée.');
    }
}
