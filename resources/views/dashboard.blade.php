@extends('layouts.etudiant')

@section('title', 'Logements disponibles')

@section('content')
<div class="max-w-7xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Logements disponibles</h1>

    {{-- Présentation des logements --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @forelse($logements as $logement)
            <div class="bg-white rounded shadow overflow-hidden">
                @if($logement->photos->isNotEmpty())
                    <div class="grid grid-cols-3 gap-1 p-2 bg-gray-100">
                        @foreach($logement->photos as $photo)
                            <a href="{{ asset('storage/' . $photo->chemin) }}" target="_blank">
                                <img src="{{ asset('storage/' . $photo->chemin) }}" alt="Photo" class="h-24 w-full object-cover rounded hover:opacity-80 transition duration-200">
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                        Aucune image disponible
                    </div>
                @endif

                <div class="p-4">
                    <h2 class="text-lg font-semibold">{{ $logement->adresse }}</h2>
                    <p class="text-sm text-gray-600">{{ ucfirst($logement->type) }} - {{ $logement->superficie }} m²</p>
                    <p class="text-blue-600 font-bold mt-2">{{ number_format($logement->loyer, 0, ',', ' ') }} FCFA/mois</p>

                    {{-- Vérification si le logement est déjà réservé (avec une variable booléenne fournie par le contrôleur) --}}
                    @if ($logement->estDejaReserve ?? false)
                        <p class="text-red-600 font-semibold mt-2">Déjà réservé</p>
                    @endif

                    <div class="mt-3 flex space-x-3">
                        <a href="{{ route('etudiant.logements.show', $logement) }}"
                           class="text-sm text-white bg-blue-600 px-4 py-2 rounded hover:bg-blue-700">
                            Voir détails
                        </a>
                        <a href="{{ route('etudiant.logements.avis', $logement->id) }}"
                           class="text-sm text-white bg-gray-600 px-4 py-2 rounded hover:bg-gray-700">
                            Donner un avis
                        </a>
                        <a href="{{ route('etudiants.messages.conversation', ['proprietaireId' => $logement->proprietaire_id]) }}" 
                           class="inline-block text-sm text-white bg-yellow-600 px-4 py-2 rounded hover:bg-yellow-700 transition-colors duration-200">
                            Discuter
                        </a>
                    </div>
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
