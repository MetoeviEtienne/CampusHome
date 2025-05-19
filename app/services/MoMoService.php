<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class MoMoService
{
    protected $baseUrl;
    protected $primaryKey;
    protected $secondaryKey;
    protected $targetEnv;

    public function __construct()
    {
        $this->baseUrl = config('services.momo.base_url');
        $this->primaryKey = config('services.momo.primary_key');
        $this->secondaryKey = config('services.momo.secondary_key');
        $this->targetEnv = config('services.momo.target_env');
    }

    // Méthode pour générer un token OAuth 2.0 pour l'API MoMo
    public function getAccessToken()
    {
        $response = Http::withBasicAuth($this->primaryKey, $this->secondaryKey)
            ->post($this->baseUrl . '/collection/token/');

        if ($response->successful()) {
            return $response->json()['access_token'];
        }
        return null;
    }

    // Méthode pour initier le paiement
    public function requestToPay($transactionId, $amount, $phone)
    {
        $token = $this->getAccessToken();
        if (!$token) {
            return null;
        }

        $payload = [
            'amount' => number_format($amount, 2, '.', ''),
            'currency' => 'EUR', // adapte selon ta monnaie
            'externalId' => $transactionId,
            'payer' => [
                'partyIdType' => 'MSISDN',
                'partyId' => $phone,
            ],
            'payerMessage' => "Paiement avance CampusHome",
            'payeeNote' => "Paiement avance logement",
        ];

        return Http::withToken($token)
            ->withHeaders([
                'X-Target-Environment' => $this->targetEnv,
                'X-Callback-Url' => route('paiement.momo.callback'),
                'Content-Type' => 'application/json',
            ])
            ->post($this->baseUrl . '/collection/v1_0/requesttopay', $payload);
    }
}


// class MoMoService
// {
//     protected $subscriptionKey;
//     protected $userId;
//     protected $apiKey;
//     protected $baseUrl;
//     protected $targetEnv;

//     // public function __construct()
//     // {
//     //     $this->subscriptionKey = config('services.momo.primary_key');
//     //     $this->userId = config('services.momo.api_user_id');
//     //     $this->apiKey = config('services.momo.api_key');
//     //     $this->baseUrl = config('services.momo.base_url');
//     //     $this->targetEnv = config('services.momo.target_env');
//     // }

//     public function getAccessToken()
//     {
//         $credentials = base64_encode("{$this->userId}:{$this->apiKey}");

//         $response = Http::withHeaders([
//             'Authorization' => "Basic {$credentials}",
//             'Ocp-Apim-Subscription-Key' => $this->subscriptionKey,
//         ])->post("{$this->baseUrl}/collection/token/");

//         if ($response->successful()) {
//             return $response->json()['access_token'];
//         }

//         throw new \Exception("Erreur de génération de l'access token : " . $response->body());
//     }

//     public function requestToPay($phone, $amount, $externalId, $payerMessage = "Paiement réservation", $payeeNote = "CampusHome")
//     {
//         $token = $this->getAccessToken();
//         $uuid = Str::uuid();

//         $response = Http::withHeaders([
//             'Authorization' => "Bearer {$token}",
//             'X-Reference-Id' => $uuid,
//             'X-Target-Environment' => $this->targetEnv,
//             'Ocp-Apim-Subscription-Key' => $this->subscriptionKey,
//             'Content-Type' => 'application/json',
//         ])->post("{$this->baseUrl}/collection/v1_0/requesttopay", [
//             "amount" => $amount,
//             "currency" => "XOF",
//             "externalId" => $externalId,
//             "payer" => [
//                 "partyIdType" => "MSISDN",
//                 "partyId" => $phone
//             ],
//             "payerMessage" => $payerMessage,
//             "payeeNote" => $payeeNote
//         ]);

//         if ($response->status() === 202) {
//             return $uuid; // identifiant de la transaction
//         }

//         throw new \Exception("Erreur de paiement : " . $response->body());
//     }
// } 
