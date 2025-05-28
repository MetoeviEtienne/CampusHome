@extends('layouts.naveshow')

@section('head')
    <script src="https://cdn.kkiapay.me/k.js"></script>
@endsection

@section('content')
<div class="max-w-md mx-auto bg-white p-8 rounded-3xl shadow-lg border border-gray-200 mt-12">
    <h2 class="text-3xl font-extrabold text-blue-700 mb-6 text-center">Paiement du loyer</h2>

    <p class="text-center text-gray-700 mb-8 text-lg">
        Montant à payer : 
        <span class="font-semibold text-blue-600">{{ number_format($montant, 0, ',', ' ') }} FCFA</span>
    </p>

    <button 
        onclick="payer()" 
        class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-indigo-600 hover:to-blue-600
               text-white font-semibold py-3 rounded-xl shadow-md transition duration-300 ease-in-out
               focus:outline-none focus:ring-4 focus:ring-blue-300"
        type="button"
        aria-label="Payer maintenant"
    >
        Payer maintenant
    </button>
</div>
@endsection

@section('scripts')
<script>
    function payer() {
        openKkiapayWidget({
            amount: "{{ $montant }}",
            key: "{{ $publicKey }}",
            data: "{{ $reservation->id }}|{{ $type }}",
            name: "{{ auth()->user()->name }}",
            email: "{{ auth()->user()->email }}",
            phone: "{{ $phone }}",
            position: "center",
            theme: "#2563eb", // bleu Tailwind (blue-600)
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
        alert('Échec du paiement. Veuillez réessayer.');
    });
</script>
@endsection





{{-- @extends('layouts.naveshow')

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
            // data: "{{ $reservation->id }}",
            data: "{{ $reservation->id }}|{{ $type }}", // on encode les deux valeurs
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



 --}}
