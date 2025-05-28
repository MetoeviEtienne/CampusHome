@extends('layouts.proprietaire')

@section('title', 'Mes logements')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-center gap-4">
    <h2 class="text-2xl font-extrabold text-gray-800">Mes logements</h2>
    <a href="{{ route('proprietaire.logements.create') }}" 
       class="inline-block bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-2 rounded-lg shadow-md 
              hover:from-blue-700 hover:to-indigo-700 transition duration-300 ease-in-out font-semibold">
        + Ajouter un logement
    </a>
</div>

@if ($logements->isEmpty())
    <p class="text-center text-gray-500 text-lg mt-20">Aucun logement enregistré pour le moment.</p>
@else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($logements as $logement)
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col">
                
                {{-- Photos --}}
                @if ($logement->photos->isNotEmpty())
                    <div class="grid grid-cols-3 gap-1 p-2 bg-gray-50 border-b">
                        @foreach($logement->photos as $photo)
                            <a href="{{ asset('storage/' . $photo->chemin) }}" target="_blank" class="overflow-hidden rounded">
                                <img src="{{ asset('storage/' . $photo->chemin) }}" alt="Photo" class="h-24 w-full object-cover rounded hover:opacity-80 transition duration-200">
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="h-48 bg-gray-100 flex items-center justify-center text-gray-400 italic font-light border-b">
                        Aucune image disponible
                    </div>
                @endif

                <div class="p-5 flex flex-col flex-grow">
                    <h3 class="font-bold text-xl text-gray-900 mb-1 truncate">{{ $logement->titre }}</h3>
                    <p class="text-sm text-gray-600 truncate">{{ $logement->adresse }}</p>

                    <p class="text-indigo-600 font-bold text-lg mt-3">
                        {{ number_format($logement->loyer, 0, ',', ' ') }} FCFA / mois
                    </p>

                    <div class="mt-2 text-gray-700 text-sm space-y-1 flex-grow">
                        <p><span class="font-semibold">Propriétaire :</span> {{ $logement->proprietaire->name }}</p>
                        <p><span class="font-semibold">Téléphone :</span> {{ $logement->proprietaire->phone ?? 'Non renseigné' }}</p>
                        <p class="mt-3"><span class="font-semibold">Description :</span> {{ Str::limit($logement->description, 120) }}</p>
                    </div>

                    <div class="mt-4">
                        @if($logement->valide)
                            <span class="inline-block text-xs bg-green-100 text-green-800 px-3 py-1 rounded-full font-semibold tracking-wide">Publié</span>
                        @elseif($logement->etat === 'rejeté')
                            <span class="inline-block text-xs bg-red-100 text-red-800 px-3 py-1 rounded-full font-semibold tracking-wide">Rejeté</span>
                        @else
                            <span class="inline-block text-xs bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full font-semibold tracking-wide">En attente</span>
                        @endif
                    </div>

                    <div class="mt-6 flex justify-between text-sm text-indigo-600 font-medium">
                        <a href="{{ route('proprietaire.logements.edit', $logement) }}" class="hover:underline focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded">
                            Modifier
                        </a>
                        <form action="{{ route('proprietaire.logements.destroy', $logement) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="hover:underline text-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 rounded">
                                Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
