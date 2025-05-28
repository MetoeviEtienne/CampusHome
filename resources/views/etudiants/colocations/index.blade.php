@extends('layouts.naveshow')

@section('title', 'Annonces de colocation')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-10">📢 Annonces de colocation</h1>

    @if($colocations->isEmpty())
        <div class="bg-yellow-100 text-yellow-800 border border-yellow-300 p-6 rounded-lg shadow text-center">
            Aucune annonce disponible pour le moment.
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($colocations as $colocation)
                @php
                    $logement = $colocation->reservation->logement;
                @endphp

                <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition duration-300 p-6 relative">
                    <div class="absolute top-4 right-4 bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                        {{ $colocation->nombre_places }} place(s)
                    </div>

                    <h2 class="text-xl font-bold text-gray-800 mb-2">{{ $logement->titre }}</h2>

                    <p class="text-xs text-gray-400 mb-2">
                        <i class="far fa-clock mr-1 text-gray-500"></i>
                        Publiée le {{ $colocation->created_at->format('d/m/Y à H:i') }} par {{ $colocation->reservation->etudiant->name }}
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

                    <a href="{{ route('etudiant.logements.show', $logement->id) }}"
                       class="mt-6 inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2 rounded-lg transition duration-300 text-sm">
                        Voir le logement
                    </a>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
