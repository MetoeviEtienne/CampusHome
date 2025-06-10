@extends('layouts.proprietaire')

@section('title', 'Chambres du logement')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-center gap-4">
    <h2 class="text-2xl font-extrabold text-gray-800">Chambres du logement : {{ $logement->titre }}</h2>
    <a href="{{ route('proprietaire.chambres.create', $logement) }}"
       class="inline-block bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-2 rounded-lg shadow-md
              hover:from-blue-700 hover:to-indigo-700 transition duration-300 ease-in-out font-semibold">
        + Ajouter une chambre
    </a>
</div>

@if ($chambres->isEmpty())
    <p class="text-center text-gray-500 text-lg mt-20">Aucune chambre enregistrée pour ce logement.</p>
@else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($chambres as $chambre)
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col">
                <div class="p-5 flex flex-col flex-grow">
                    <h3 class="font-bold text-xl text-gray-900 mb-1 truncate">Chambre {{ $chambre->numero }}</h3>
                    <p class="text-indigo-600 font-bold text-lg mt-3">
                        {{ number_format($chambre->loyer, 0, ',', ' ') }} FCFA / mois
                    </p>
                    <div class="mt-2 text-gray-700 text-sm space-y-1 flex-grow">
                        <p><span class="font-semibold">Superficie :</span> {{ $chambre->superficie }} m²</p>
                        <p><span class="font-semibold">Disponibilité :</span> {{ $chambre->disponibilite->format('d/m/Y') }}</p>
                    </div>
                    <div class="mt-6 flex justify-between text-sm text-indigo-600 font-medium">
                        <a href="{{ route('proprietaire.logements.chambres.index', $logement) }}" class="hover:underline focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded">
                            Voir les chambres
                        </a>
                        <a href="{{ route('proprietaire.chambres.edit', [$logement, $chambre]) }}" class="hover:underline focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded">
                            Modifier
                        </a>
                        <form action="{{ route('proprietaire.chambres.destroy', [$logement, $chambre]) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
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
