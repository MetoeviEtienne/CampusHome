<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paiement;
use Illuminate\Support\Str;
use App\Models\Reservation;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;


class PaiementController extends Controller
{
    // Méthode pour initier le paiement
    public function initierPaiement(Request $request)
    {
        $reservation = Reservation::findOrFail($request->reservation_id);
        $type = $request->type;

        // Déterminer le montant en fonction du type
        if ($type === 'avance') {
            $montant = $reservation->logement->loyer * 3.5;
        } else {
            $montant = $reservation->logement->loyer;
        }

        return view('paiements.kkiapay', [
            'reservation' => $reservation,
            'montant' => $montant,
            'type' => $type,
            'phone' => $request->phone,
            'publicKey' => 'd17bdb0035a011f0b74aa937c88f6801', // à sécuriser
        ]);
    }

    // Callback de Kkiapay
    public function callback(Request $request)
        {
            $reservationId = $request->get('data');
            $status = $request->get('status');
            $amount = floatval($request->get('amount'));
            $transactionId = $request->get('transactionId');

            $reservation = Reservation::with('logement.proprietaire', 'etudiant')->findOrFail($reservationId);
            $logement = $reservation->logement;
            $etudiant = $reservation->etudiant;
            $proprietaire = $logement->proprietaire;

            if ($status === 'SUCCESS') {
                // Détection du type
                $avance = round($logement->loyer * 3.5, 2);
                $typePaiement = $amount >= $avance ? 'avance' : 'mensuel';

                // Calcul taxe
                $taxe = $typePaiement === 'avance' ? $amount * 0.15 : 0;

                // Génération du reçu PDF
                $pdf = Pdf::loadView('pdf.recu', [
                    'reservation' => $reservation,
                    'logement' => $logement,
                    'etudiant' => $etudiant,
                    'proprietaire' => $proprietaire,
                    'montant' => $amount,
                    'type' => $typePaiement,
                    'taxe' => $taxe,
                    'transactionId' => $transactionId,
                ]);

                $fileName = 'recu_' . uniqid() . '.pdf';
                $path = 'reçus/' . $fileName;
                Storage::put("public/{$path}", $pdf->output());

                // Enregistrement du paiement
                $paiement = Paiement::create([
                    'reservation_id' => $reservation->id,
                    'montant' => $amount,
                    'type' => $typePaiement,
                    'taxe' => $taxe,
                    'methode' => 'kkiapay',
                    'reference' => $transactionId ?? Str::uuid(),
                    'statut' => 'payé',
                    'quittance' => $path,
                ]);
                // Notification par mail
                // Notification par mail avec le reçu PDF
        $etudiant->notify(new \App\Notifications\RecuPaiementNotification($paiement, $etudiant));
        $proprietaire->notify(new \App\Notifications\RecuPaiementNotification($paiement, $proprietaire));

                return redirect()->route('etudiant.reservations.index')->with('success', 'Paiement réussi !');
            }

         return redirect()->route('etudiant.reservations.index')->with('error', 'Échec du paiement.');
    }
    // Methode pour télécharger le reçu de paiement
    public function telechargerRecu(Paiement $paiement)
        {
            $reservation = $paiement->reservation;
            $logement = $reservation->logement;
            $etudiant = $reservation->etudiant;
            $proprietaire = $logement->proprietaire;

            $pdf = Pdf::loadView('pdf.recu', [
                'paiement' => $paiement,
                'transactionId' => $paiement->reference,
                'montant' => $paiement->montant,
                'taxe' => $paiement->taxe,
                'type' => $paiement->type ?? 'mensuel', // On suppose qu’un champ 'type' sera ajouté
                'etudiant' => $etudiant,
                'proprietaire' => $proprietaire,
                'logement' => $logement,
            ]);

            return $pdf->download('recu-paiement-'.$paiement->id.'.pdf');
        }
}


    // public function callback(Request $request)
    // {
    //     $reservationId = $request->get('data');
    //     $status = $request->get('status');
    //     $amount = $request->get('amount');
    //     $transactionId = $request->get('transactionId');

    //     if ($status === 'SUCCESS') {
    //         Paiement::create([
    //             'reservation_id' => $reservationId,
    //             'montant' => $amount,
    //             'taxe' => $amount * 0.15,
    //             'methode' => 'kkiapay',
    //             'reference' => $transactionId ?? Str::uuid(),
    //             'statut' => 'payé',
    //         ]);

    //         return redirect()->route('etudiant.reservations.index')->with('success', 'Paiement réussi !');
    //     }

    //     return redirect()->route('etudiant.reservations.index')->with('error', 'Échec du paiement.');
    // }

// class PaiementController extends Controller
// {
//     public function initierPaiement(Request $request)
//     {
//         $reservation = Reservation::findOrFail($request->reservation_id);
//         $montant = $request->amount;

//         return view('paiements.kkiapay', [
//             'reservation' => $reservation,
//             'montant' => $montant,
//             'phone' => $request->phone,
//             'publicKey' => 'd17bdb0035a011f0b74aa937c88f6801', // à sécuriser plus tard
//         ]);
//     }

//     public function callback(Request $request)
//         {
//             // Ici, on suppose que le data contient l'ID de réservation
//             $reservationId = $request->get('data'); // transmis depuis le widget
//             $status = $request->get('status'); // success, failed
//             $amount = $request->get('amount');
//             $transactionId = $request->get('transactionId'); // ou reference

//             if ($status === 'SUCCESS') {
//                 Paiement::create([
//                     'reservation_id' => $reservationId,
//                     'montant' => $amount,
//                     'taxe' => $amount * 0.15,
//                     'methode' => 'kkiapay',
//                     'reference' => $transactionId ?? Str::uuid(),
//                     'statut' => 'payé',
//                 ]);

//                 return redirect()->route('etudiant.reservations.index')->with('success', 'Paiement réussi !');
//             }

//             return redirect()->route('etudiant.reservations.index')->with('error', 'Échec du paiement.');
//         }

// }


// class PaiementController extends Controller
// {
//     protected $momo;

//     public function __construct(MoMoService $momo)
//     {
//         $this->momo = $momo;
//     }

//     public function payer(Request $request)
//     {
//         $request->validate([
//             'phone' => 'required|string',
//             'amount' => 'required|numeric|min:100',
//             'reservation_id' => 'required|integer|exists:reservations,id',
//         ]);

//         $transactionId = (string) Str::uuid();
//         $amount = $request->amount;
//         $phone = $request->phone;

//         $response = $this->momo->requestToPay($transactionId, $amount, $phone);

//         if ($response && $response->successful()) {
//             Paiement::create([
//                 'reservation_id' => $request->reservation_id,
//                 'montant' => $amount,
//                 'taxe' => $amount * 0.15,
//                 'methode' => 'MTN MoMo',
//                 'reference' => $transactionId,
//                 'statut' => 'en_attente',
//             ]);

//             return back()->with('success', 'Paiement initié avec succès, en attente de confirmation.');
//         }

//         return back()->with('error', 'Impossible d’initier le paiement.');
//     }

//     // Pour plus tard : gérer le callback MoMo ici
//     public function callback(Request $request)
//     {
//         // à implémenter
//     }
// }

// class PaiementController extends Controller
// {
//     protected $momo;

//     public function __construct(MoMoService $momo)
//     {
//         $this->momo = $momo;
//     }

//     public function payer(Request $request)
//     {
//         $request->validate([
//             'phone' => 'required|string',
//             'amount' => 'required|numeric|min:100',
//         ]);

//         $transactionId = (string) Str::uuid();
//         $amount = $request->amount;
//         $phone = $request->phone;

//         $response = $this->momo->requestToPay($transactionId, $amount, $phone);

//         if ($response->successful()) {
//             // Stocker dans la base
//             Paiement::create([
//                 'reservation_id' => $request->reservation_id, // à passer dans le formulaire
//                 'montant' => $amount,
//                 'taxe' => $amount * 0.15, // Exemple de calcul taxe
//                 'methode' => 'MTN MoMo',
//                 'reference' => $transactionId,
//                 'statut' => 'en_attente',
//             ]);

//             return back()->with('success', 'Paiement initié avec succès. En attente de confirmation.');
//         }

//         return back()->with('error', 'Échec de l’initiation du paiement.');
//     }
// }
