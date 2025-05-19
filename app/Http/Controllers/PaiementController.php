<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MoMoService;
use App\Models\Paiement;
use Illuminate\Support\Str;

class PaiementController extends Controller
{
    protected $momo;

    public function __construct(MoMoService $momo)
    {
        $this->momo = $momo;
    }

    public function payer(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'amount' => 'required|numeric|min:100',
            'reservation_id' => 'required|integer|exists:reservations,id',
        ]);

        $transactionId = (string) Str::uuid();
        $amount = $request->amount;
        $phone = $request->phone;

        $response = $this->momo->requestToPay($transactionId, $amount, $phone);

        if ($response && $response->successful()) {
            Paiement::create([
                'reservation_id' => $request->reservation_id,
                'montant' => $amount,
                'taxe' => $amount * 0.15,
                'methode' => 'MTN MoMo',
                'reference' => $transactionId,
                'statut' => 'en_attente',
            ]);

            return back()->with('success', 'Paiement initié avec succès, en attente de confirmation.');
        }

        return back()->with('error', 'Impossible d’initier le paiement.');
    }

    // Pour plus tard : gérer le callback MoMo ici
    public function callback(Request $request)
    {
        // à implémenter
    }
}

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
