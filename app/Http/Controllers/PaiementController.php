<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paiement;
use Illuminate\Support\Str;
use App\Models\Reservation;
use Illuminate\Support\Facades\Log;

class PaiementController extends Controller
{
    public function initierPaiement(Request $request)
    {
        $reservation = Reservation::findOrFail($request->reservation_id);

        // Récupération du loyer depuis le logement lié à la réservation
        $montant = $reservation->logement->loyer;

        return view('paiements.kkiapay', [
            'reservation' => $reservation,
            'montant' => $montant,
            'phone' => $request->phone,
            'publicKey' => 'd17bdb0035a011f0b74aa937c88f6801', // à sécuriser
        ]);
    }

    public function callback(Request $request)
    {
        $reservationId = $request->get('data');
        $status = $request->get('status');
        $amount = $request->get('amount');
        $transactionId = $request->get('transactionId');

        if ($status === 'SUCCESS') {
            Paiement::create([
                'reservation_id' => $reservationId,
                'montant' => $amount,
                'taxe' => $amount * 0.15,
                'methode' => 'kkiapay',
                'reference' => $transactionId ?? Str::uuid(),
                'statut' => 'payé',
            ]);

            return redirect()->route('etudiant.reservations.index')->with('success', 'Paiement réussi !');
        }

        return redirect()->route('etudiant.reservations.index')->with('error', 'Échec du paiement.');
    }
}
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
