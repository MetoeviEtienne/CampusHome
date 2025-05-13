@extends('layouts.proprietaire')

@section('title', 'Mes logements')

@section('content')
<div class="mb-4 flex justify-between items-center">
    <h2 class="text-xl font-semibold text-gray-700">Mes logements</h2>
    <a href="{{ route('proprietaire.logements.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300 ease-in-out">
        + Ajouter un logement
    </a>
</div>

@if ($logements->isEmpty())
    <p class="text-gray-600">Aucun logement enregistré pour le moment.</p>
@else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($logements as $logement)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 ease-in-out">
                
                {{-- Affichage des photos --}}
                @if ($logement->photos->isNotEmpty())
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
                    <h3 class="font-semibold text-lg text-gray-800">{{ $logement->titre }}</h3>
                    <p class="text-sm text-gray-600">{{ $logement->adresse }}</p>
                    <p class="text-blue-600 font-semibold mt-2">{{ number_format($logement->loyer, 0, ',', ' ') }} FCFA/mois</p>
                    <div class="mt-2 text-sm text-gray-600">
                        <strong>Propriétaire :</strong> {{ $logement->proprietaire->name }}<br>
                        <strong>Téléphone :</strong> {{ $logement->proprietaire->phone ?? 'Non renseigné' }}
                    </div>
                    
                    <div class="mt-2 text-gray-700 text-sm">
                        <strong>Description :</strong>
                        <p>{{ $logement->description }}</p>
                    </div>
                    
                    <div class="mt-2">
                        @if($logement->valide)
                            <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full">Publié</span>
                        @else
                            <span class="bg-yellow-100 text-yellow-700 text-xs px-2 py-1 rounded-full">En attente</span>
                        @endif
                    </div>

                    <div class="mt-4 flex justify-between items-center text-sm">
                        <a href="{{ route('proprietaire.logements.edit', $logement) }}" class="text-blue-500 hover:text-blue-700 font-medium transition duration-300">Modifier</a>

                        <form action="{{ route('proprietaire.logements.destroy', $logement) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 font-medium transition duration-300">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
