@php
    $reservation = $logement->reservations()
        ->where('etudiant_id', auth()->id())
        ->latest()
        ->first();
@endphp

<div class="mt-6">
    @if (!$reservation)
        {{-- Aucune réservation pour ce logement --}}
        <a href="{{ route('etudiant.reservations.create', $logement) }}" 
           class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Réserver ce logement
        </a>
    @elseif ($reservation->statut === 'en_attente')
        <p class="text-yellow-600 font-semibold">Demande de réservation en attente de validation.</p>
    @elseif ($reservation->statut === 'approuvee')
        <p class="text-green-600 font-semibold">Réservation approuvée.</p>

        @if ($reservation->contrat)
            <a href="{{ route('etudiant.reservations.contrat', $reservation) }}" 
               class="inline-block mt-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
                Télécharger le contrat
            </a>
        @else
            <p class="text-gray-500">Contrat en cours de génération...</p>
        @endif

        {{-- Tu peux aussi ajouter un bouton pour signer le contrat ici si tu le gères plus tard --}}
    @elseif ($reservation->statut === 'rejetee' || $reservation->statut === 'annulée')
        <a href="{{ route('etudiant.reservations.create', $logement) }}" 
           class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Faire une nouvelle demande
        </a>
    @endif
</div>
@extends('layouts.etudiant')

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

        {{-- COLONNE DROITE : Description seule --}}
        <div>
            <p><strong>Description :</strong></p>
            <div class="mt-2 p-3 bg-gray-100 rounded text-justify">
                {{ $logement->description }}
            </div>
        </div>
    </div>

        <div class="mt-6">
            <a href="{{ route('etudiant.logements.index') }}" class="bg-gray-600 hover:bg-gray-800 text-white py-2 px-4 rounded">
                ← Retour à la liste
            </a>

            <div class="mt-6">
    @if (!$reservation)
        {{-- Aucune réservation pour ce logement --}}
        <a href="{{ route('etudiant.reservations.create', $logement) }}" 
           class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Réserver ce logement
        </a>
    @elseif ($reservation->statut === 'en_attente')
        <p class="text-yellow-600 font-semibold">Demande de réservation en attente de validation.</p>
    @elseif ($reservation->statut === 'approuvee')
        <p class="text-green-600 font-semibold">Réservation approuvée.</p>

        @if ($reservation->contrat)
            <a href="{{ route('etudiant.reservations.contrat', $reservation) }}" 
               class="inline-block mt-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
                Télécharger le contrat
            </a>
        @else
            <p class="text-gray-500">Contrat en cours de génération...</p>
        @endif

        {{-- Tu peux aussi ajouter un bouton pour signer le contrat ici si tu le gères plus tard --}}
    @elseif ($reservation->statut === 'rejetee' || $reservation->statut === 'annulée')
        <a href="{{ route('etudiant.reservations.create', $logement) }}" 
           class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Faire une nouvelle demande
        </a>
    @endif
</div>
        </div>
    </div>
</div>
@endsection
