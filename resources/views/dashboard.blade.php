@extends('layouts.etudiant')

@section('title', 'Logements disponibles')

@section('content')
<div class="max-w-7xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Logements disponibles</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @forelse($logements as $logement)
            <div class="bg-white rounded shadow overflow-hidden">
                @if($logement->photos->isNotEmpty())
                    <img src="{{ asset('storage/' . $logement->photos->first()->chemin) }}" alt="Photo" class="h-48 w-full object-cover">
                @endif
                <div class="p-4">
                    <h2 class="text-lg font-semibold">{{ $logement->adresse }}</h2>
                    <p class="text-sm text-gray-600">{{ ucfirst($logement->type) }} - {{ $logement->superficie }} m²</p>
                    <p class="text-blue-600 font-bold mt-2">{{ number_format($logement->loyer, 0, ',', ' ') }} FCFA/mois</p>
                    <a href="{{ route('etudiant.logements.show', $logement) }}"
                       class="inline-block mt-3 text-sm text-white bg-blue-600 px-4 py-2 rounded hover:bg-blue-700">
                        Voir détails
                    </a>
                </div>
            </div>
        @empty
            <p class="text-gray-500">Aucun logement disponible pour le moment.</p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $logements->links() }}
    </div>
</div>
@endsection
