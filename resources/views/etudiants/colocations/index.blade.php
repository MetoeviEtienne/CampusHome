@extends('layouts.naveshow')

@section('title', 'Annonces de colocation')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-10">📢 Recherche de colocation</h1>

    @if($colocations->isEmpty())
        <div class="bg-yellow-100 text-yellow-800 border border-yellow-300 p-6 rounded-lg shadow text-center">
            Aucune annonce disponible pour le moment.
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($colocations as $colocation)
                @php
                    $logement = $colocation->reservation->logement;
                    $etudiant = $colocation->reservation->etudiant;
                @endphp

                <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition duration-300 p-6 relative">
                    <div class="absolute top-4 right-4 bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                        {{ $colocation->nombre_places }} place(s)
                    </div>

                    <h2 class="text-xl font-bold text-gray-800 mb-2">{{ $logement->titre }}</h2>

                    <p class="text-xs text-gray-400 mb-2">
                        <i class="far fa-clock mr-1 text-gray-500"></i>
                        Publiée le {{ $colocation->created_at->format('d/m/Y à H:i') }} par {{ $etudiant->name }}
                    </p>

                    <p class="text-sm text-gray-500 mb-1">
                        <i class="fas fa-map-marker-alt text-blue-500 mr-1"></i>
                        {{ $logement->adresse }}
                    </p>

                    <p class="text-sm text-gray-500 mb-1">
                        <i class="fas fa-phone-alt text-green-500 mr-1"></i>
                        {{ $colocation->telephone }}
                    </p>

                    <div class="mt-4 text-gray-700 text-sm leading-relaxed">
                        {{ $colocation->description }}
                    </div>

                    <div class="mt-6 flex flex-col sm:flex-row sm:justify-between gap-3">
                        <a href="{{ route('etudiant.logements.show', $logement->id) }}"
                           class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2 rounded-lg transition duration-300 text-sm text-center w-full sm:w-auto">
                            Voir le logement
                        </a>

                        @if(auth()->id() === $etudiant->id)
                            <form action="{{ route('etudiant.colocations.destroy', $colocation->id) }}" method="POST" class="w-full sm:w-auto">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Es-tu sûr de vouloir supprimer cette annonce ?')"
                                        class="bg-red-600 hover:bg-red-700 text-white font-medium px-5 py-2 rounded-lg transition duration-300 text-sm text-center w-full">
                                    Supprimer l'annonce
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
