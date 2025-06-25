<?php
namespace App\Http\Controllers\Proprietaire;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Notifications\ReservationApproved;
use App\Notifications\ReservationRejected;
use App\Notifications\VisiteConfirmee;
use App\Notifications\VisiteRejetee;
use PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
        {
            public function index()
            {

                $user = auth()->user();

                if (!$user) {
                    abort(403, "Vous devez être connecté.");
                }

                if ($user->role !== 'owner') {
                    abort(403, "Accès réservé aux propriétaires.");
                }

                $logementIds = $user->logements()->pluck('id');

                // Récupère les logements du propriétaire
                $logementIds = auth()->user()->logements()->pluck('id');

                // Récupère les réservations associées à ces logements
                $reservations = Reservation::whereIn('logement_id', $logementIds)
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

            // Vérifier s'il existe déjà une réservation approuvée sur la même période et logement
            $overlapping = Reservation::where('logement_id', $reservation->logement_id)
                ->where('statut', 'approuvee')
                ->where(function ($query) use ($reservation) {
                    $query->whereBetween('date_debut', [$reservation->date_debut, $reservation->date_fin])
                        ->orWhereBetween('date_fin', [$reservation->date_debut, $reservation->date_fin])
                        ->orWhere(function ($q) use ($reservation) {
                            $q->where('date_debut', '<=', $reservation->date_debut)
                                ->where('date_fin', '>=', $reservation->date_fin);
                        });
                })
                ->exists();

            if ($overlapping) {
                return back()->with('error', 'Ce logement est déjà réservé pour cette période.');
            }

            // Mettre à jour le statut
            $reservation->update(['statut' => 'approuvee']);

            // Envoie une notification par e-mail/SMS
            // $reservation->etudiant->notify(new ReservationConfirmeeNotification($reservation));
            // Génération du contrat PDF
            $pdf = PDF::loadView('contrats.contrat', [
                'reservation' => $reservation,
                'etudiant' => $reservation->etudiant,
                'logement' => $reservation->logement,
            ]);

            $fileName = 'contrats/contrat_' . $reservation->id . '.pdf';
            Storage::disk('public')->put($fileName, $pdf->output());

            // Sauvegarder le chemin dans la réservation
            $reservation->contrat = $fileName;
            $reservation->save();

            // Notification
            $reservation->etudiant->notify(new ReservationApproved($reservation));

            return back()->with('success', 'Réservation approuvée avec succès et contrat généré.');
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

    // Fonction pour la confirmation de visite
     public function confirmerVisite(Reservation $reservation)
    {
        // Vérifie que le propriétaire connecté est bien celui du logement
        if (auth()->id() !== $reservation->logement->proprietaire_id) {
            abort(403);
        }

        // On confirme la visite
        $reservation->update([
            'visite_confirmee' => true,
        ]);

        // 🔥 Ajout essentiel pour éviter une erreur dans la notification
        $reservation->loadMissing('logement');

        // dd($reservation->etudiant->email);
        // Notification à l’étudiant
        $reservation->etudiant->notify(new VisiteConfirmee($reservation));

        return redirect()->back()->with('success', 'Visite confirmée avec succès.');
    }

    // Fonction pour rejecter la visite
    public function rejeterVisite(Reservation $reservation)
    {
        if ($reservation->logement->proprietaire_id !== auth()->id()) {
            abort(403);
        }

        $reservation->update([
            'visite_confirmee' => false,
            'visite_rejetee' => true,
        ]);

        // Notifie l'étudiant
        $reservation->etudiant->notify(new VisiteRejetee($reservation));

        return back()->with('success', 'La visite a été rejetée.');
    }


    public function destroy(Reservation $reservation)
    {
        // Vérifie que le logement appartient au propriétaire connecté
        if ($reservation->logement->proprietaire_id !== auth()->id()) {
            abort(403);
        }

        $reservation->delete();

        return redirect()->back()->with('success', 'Réservation supprimée avec succès.');
    }

}



// public function approver(Reservation $reservation)
    // {
    //     if ($reservation->logement->proprietaire_id !== auth()->id()) {
    //         abort(403);
    //     }

    //     // Vérifier s'il existe déjà une réservation approuvée sur la même période et logement
    //     $overlapping = Reservation::where('logement_id', $reservation->logement_id)
    //         ->where('statut', 'approuvee')
    //         ->where(function ($query) use ($reservation) {
    //             $query->whereBetween('date_debut', [$reservation->date_debut, $reservation->date_fin])
    //                 ->orWhereBetween('date_fin', [$reservation->date_debut, $reservation->date_fin])
    //                 ->orWhere(function ($q) use ($reservation) {
    //                     $q->where('date_debut', '<=', $reservation->date_debut)
    //                         ->where('date_fin', '>=', $reservation->date_fin);
    //                 });
    //         })
    //         ->exists();

    //     if ($overlapping) {
    //         return back()->with('error', 'Ce logement est déjà réservé pour cette période.');
    //     }

    //     // Mettre à jour le statut
    //     $reservation->update(['statut' => 'approuvee']);

    //     // Génération du contrat PDF
    //     $pdf = PDF::loadView('contrats.contrat', [
    //         'reservation' => $reservation,
    //         'etudiant' => $reservation->etudiant,
    //         'logement' => $reservation->logement,
    //     ]);

    //     $fileName = 'contrats/contrat_' . $reservation->id . '.pdf';
    //     Storage::disk('public')->put($fileName, $pdf->output());

    //     // Sauvegarder le chemin dans la réservation
    //     $reservation->contrat = $fileName;
    //     $reservation->save();

    //     // Notification
    //     $reservation->etudiant->notify(new ReservationApproved($reservation));

    //     return back()->with('success', 'Réservation approuvée avec succès et contrat généré.');
    // }


    //     $reservation->update(['statut' => 'approuvee']);

    //     // Notification
    //     $reservation->etudiant->notify(new ReservationApproved($reservation));

    //     // TODO : génération automatique du contrat PDF (à faire ici si besoin)

    //     return back()->with('success', 'Réservation approuvée avec succès.');
    // }
