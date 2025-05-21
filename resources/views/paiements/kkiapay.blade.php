@extends('layouts.naveshow')

@section('head')
    <script src="https://cdn.kkiapay.me/k.js"></script>
@endsection

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Paiement du loyer</h2>
    <p class="mb-4">Montant à payer : <strong>{{ $montant }} FCFA</strong></p>
    <button onclick="payer()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Payer maintenant</button>
</div>
@endsection

@section('scripts')
<script>
    function payer() {
        openKkiapayWidget({
            amount: "{{ $montant }}",
            key: "{{ $publicKey }}",
            data: "{{ $reservation->id }}",
            name: "{{ auth()->user()->name }}",
            email: "{{ auth()->user()->email }}",
            phone: "{{ $phone }}",
            position: "center",
            theme: "#0095ff",
            sandbox: true,
            callback: "{{ route('paiement.callback') }}"
        });
    }

    addSuccessListener(response => {
        console.log('Paiement réussi', response);
        const url = new URL("{{ route('paiement.callback') }}");
        url.searchParams.append("data", "{{ $reservation->id }}");
        url.searchParams.append("status", "SUCCESS");
        url.searchParams.append("amount", "{{ $montant }}");
        url.searchParams.append("transactionId", response.transactionId);

        window.location.href = url.toString();
    });

    addFailedListener(error => {
        console.error('Paiement échoué', error);
        alert('Échec du paiement');
    });
</script>
@endsection




{{-- @extends('layouts.naveshow')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white shadow p-6 rounded">
    <h2 class="text-lg font-bold mb-4">Paiement avec Kkiapay</h2>
    <p>Montant à payer : <strong>{{ $montant }} FCFA</strong></p>

    <kkiapay-widget 
        amount="{{ $montant }}"
        key="{{ $publicKey }}"
        callback="{{ route('paiement.callback') }}"
        name="{{ auth()->user()->name }}"
        email="{{ auth()->user()->email }}"
        phone="{{ $phone }}"
        data="{{ $reservation->id }}"
        theme="#1e40af"
    ></kkiapay-widget>
</div>

<script src="https://cdn.kkiapay.me/k.js"></script>
@endsection --}}
{{-- <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Paiement</title>
</head>
<body>
    <h2>Paiement du loyer</h2>
    <button onclick="payer()">Payer maintenant</button>

    <script src="https://cdn.kkiapay.me/k.js"></script>
    <script>
        function payer() {
            openKkiapayWidget({
                amount: "{{ $montant }}",
                key: "{{ $publicKey }}",
                data: "{{ $reservation->id }}",
                name: "{{ auth()->user()->name }}",
                email: "{{ auth()->user()->email }}",
                phone: "{{ $phone }}",
                position: "center",
                theme: "#0095ff",
                sandbox: true, // à enlever en production
                callback: "{{ route('paiement.callback') }}"
            });
        }

        addSuccessListener(response => {
            console.log('Paiement réussi', response);
            // Redirection vers la callback Laravel avec les infos nécessaires
            const url = new URL("{{ route('paiement.callback') }}");
            url.searchParams.append("data", "{{ $reservation->id }}");
            url.searchParams.append("status", "SUCCESS");
            url.searchParams.append("amount", "{{ $montant }}");
            url.searchParams.append("transactionId", response.transactionId);

            window.location.href = url.toString();
        });

        addFailedListener(error => {
            console.error('Paiement échoué', error);
            alert('Échec du paiement');
        });
    </script>
</body>
</html> --}}
