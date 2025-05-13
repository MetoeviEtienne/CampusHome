@extends('layouts.etudiant')

@section('content')
<div class="max-w-6xl mx-auto p-6 bg-white shadow rounded">
    <h1 class="text-2xl font-bold mb-6">Logements disponibles</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($logements as $logement)
            <div class="border rounded p-4 shadow">
                <h2 class="text-xl font-semibold">{{ $logement->titre }}</h2>
                <p><strong>Ville :</strong> {{ $logement->ville }}</p>
                <p><strong>Loyer :</strong> {{ $logement->loyer }} FCFA</p>

                <a href="{{ route('etudiant.logements.show', $logement) }}" class="text-blue-600 hover:underline mt-2 inline-block">
                    Voir les détails
                </a>
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $logements->links() }}
    </div>
</div>
@endsection
