<?php

namespace App\Http\Controllers\Etudiant;

use App\Http\Controllers\Controller;
use App\Models\Logement;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\MaintenanceDemandee;
use App\Models\Reservation;

class MaintenanceEtudiantController extends Controller
{

    public function create($reservationId)
    {
        // On récupère la réservation avec le logement
        $reservation = Reservation::with('logement')->findOrFail($reservationId);

        // On vérifie que la réservation appartient à l'étudiant connecté
        if ($reservation->etudiant_id !== auth()->id()) {
            abort(403);
        }

        return view('etudiants.maintenance.create', [
            'reservation' => $reservation,
            'logement' => $reservation->logement,
        ]);
    }

    public function store(Request $request, Logement $logement)
    {
        $validated = $request->validate([
            'description' => 'required|string',
            'urgence' => 'required|in:faible,moyenne,haute',
        ]);

        $maintenance = Maintenance::create([
            'logement_id' => $logement->id,
            'etudiant_id' => Auth::id(),
            'description' => $validated['description'],
            'urgence' => $validated['urgence'],
            'statut' => 'nouveau',
        ]);

        // Notification email au propriétaire
        if ($logement->proprietaire) {
            $logement->proprietaire->notify(new MaintenanceDemandee($maintenance));
        }

        return redirect()->back()->with('success', 'Demande de maintenance envoyée avec succès.');
    }
}

