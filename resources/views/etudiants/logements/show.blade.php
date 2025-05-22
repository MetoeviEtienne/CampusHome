@php
    $reservation = $logement->reservations()
        ->where('etudiant_id', auth()->id())
        ->latest()
        ->first();
    $avancePayee = $reservation && $reservation->paiements->where('type', 'avance')->where('statut', 'payé')->isNotEmpty();
@endphp

@extends('layouts.naveshow')

@section('title', 'Détails du logement')

@section('content')
<div class="max-w-5xl mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6">{{ $logement->titre }}</h1>

    {{-- PHOTOS EN GRAND FORMAT --}}
    <div class="bg-white rounded shadow overflow-hidden mb-6">
        @if($logement->photos->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                @foreach($logement->photos as $photo)
                    <img src="{{ asset('storage/' . $photo->chemin) }}"
                         alt="Photo du logement"
                         class="w-full h-96 object-cover">
                @endforeach
            </div>
        @else
            <div class="h-64 flex items-center justify-center bg-gray-200 text-gray-600">
                Aucune photo disponible
            </div>
        @endif
    </div>

    {{-- INFOS EN DESSOUS --}}
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-xl font-semibold mb-4">Informations du logement</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-800">
            {{-- COLONNE GAUCHE : Infos générales --}}
            <div class="space-y-2">
                <p><strong>Adresse :</strong> {{ $logement->adresse }}</p>
                <p><strong>Type :</strong> {{ ucfirst($logement->type) }}</p>
                <p><strong>Chambres :</strong> {{ $logement->nombre_chambres }}</p>
                <p><strong>Superficie :</strong> {{ $logement->superficie }} m²</p>
                <p><strong>Loyer :</strong> {{ number_format($logement->loyer, 0, ',', ' ') }} FCFA/mois</p>
                <p><strong>Disponible à partir du :</strong> {{ \Carbon\Carbon::parse($logement->disponibilite)->format('d/m/Y') }}</p>
                <p><strong>Propriétaire :</strong> {{ $logement->proprietaire->name }}</p>
                <p><strong>Téléphone :</strong> {{ $logement->proprietaire->phone }}</p>
            </div>

            {{-- COLONNE DROITE : Description --}}
            <div>
                <p><strong>Description :</strong></p>
                <div class="mt-2 p-3 bg-gray-100 rounded text-justify">
                    {{ $logement->description }}
                </div>
            </div>
        </div>

        {{-- ZONE BOUTONS --}}
        <div class="mt-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">

            {{-- Bouton retour --}}
            <a href="{{ route('etudiant.logements.index') }}"
               class="bg-gray-600 hover:bg-gray-800 text-white py-2 px-4 rounded w-full md:w-auto text-center">
                ← Accueil
            </a>

            {{-- Zone réservation / actions --}}
            <div class="flex flex-col gap-2 w-full md:w-auto">
                {{-- Aucun réservation OU déjà rejetée/annulée --}}
                @if (!$reservation || in_array($reservation->statut, ['rejetée', 'annulée']))
                    <a href="{{ route('etudiant.reservations.create', $logement) }}" 
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-center">
                        Réserver ce logement
                    </a>
                @elseif ($reservation->statut === 'approuvée')
                    @if ($avancePayee)
                        {{-- Avance payée : afficher "Déjà loué" + bouton maintenance --}}
                        <div class="bg-green-600 text-white px-4 py-2 rounded text-center mb-2">
                            🏠 Déjà loué
                        </div>
                        <a href="{{ route('etudiants.maintenance.create', $reservation->id) }}" 
                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded text-center">
                            Demander maintenance
                        </a>
                    @else
                        {{-- Avance pas encore payée : afficher "Déjà réservé" --}}
                        <div class="bg-gray-200 text-gray-600 px-4 py-2 rounded text-center">
                            🔒 Déjà réservé
                        </div>
                    @endif
                @else
                    {{-- Pour d'autres statuts --}}
                    <div class="bg-gray-200 text-gray-600 px-4 py-2 rounded text-center">
                        🔒 Déjà réservé
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
