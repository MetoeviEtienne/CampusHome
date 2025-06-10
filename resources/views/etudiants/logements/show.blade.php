@extends('layouts.naveshow')

@section('title', 'Détails du logement')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-bold text-gray-800 mb-8">{{ $logement->titre }}</h1>

    {{-- GALERIE PHOTOS --}}
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8">
        @if($logement->photos->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($logement->photos as $photo)
                    <img src="{{ asset('storage/' . $photo->chemin) }}"
                         alt="Photo du logement"
                         class="w-full h-96 object-cover rounded">
                @endforeach
            </div>
        @else
            <div class="h-64 flex items-center justify-center bg-gray-100 text-gray-500 text-lg">
                Aucune photo disponible
            </div>
        @endif
    </div>

    {{-- INFORMATIONS --}}
    <div class="bg-white rounded-2xl shadow-lg p-8">
        <h2 class="text-2xl font-semibold text-gray-700 mb-6">Détails du logement</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700">
            {{-- Colonne 1 --}}
            <div class="space-y-3">
                <p><span class="font-medium">📍 Adresse :</span> {{ $logement->adresse }}</p>
                <p><span class="font-semibold">Quartier :</span> {{ $logement->quartier }}</p>
                <p><span class="font-medium">🏠 Type :</span> {{ ucfirst($logement->type) }}</p>
                {{-- <p><span class="font-medium">🛏️ Chambres :</span> {{ $logement->nombre_chambres }}</p> --}}
                <p><span class="font-medium">📐 Superficie :</span> {{ $logement->superficie }} m²</p>
                <p><span class="font-medium">💰 Loyer :</span> {{ number_format($logement->loyer, 0, ',', ' ') }} FCFA/mois</p>
                <p><span class="font-medium">📅 Disponible à partir du :</span> {{ \Carbon\Carbon::parse($logement->disponibilite)->format('d/m/Y') }}</p>
                <p><span class="font-medium">👤 Propriétaire :</span> {{ $logement->proprietaire->name }}</p>
                <p><span class="font-medium">📞 Téléphone :</span> {{ $logement->proprietaire->phone }}</p>
                <p><span class="font-semibold">🏘️Numero de la Chambre :</span> {{ $logement->numChambre }}</p>
                <p><span class="font-semibold">🏯Numero de la maison :</span> {{ $logement->numMaison }}</p>
            </div>

            {{-- Colonne 2 --}}
            <div>
                <p class="font-medium">📝 Description :</p>
                <div class="mt-3 p-4 bg-gray-100 rounded-lg text-justify leading-relaxed">
                    {{ $logement->description }}
                </div>
            </div>
        </div>

        {{-- ACTIONS --}}
        <div class="mt-10 flex flex-col md:flex-row md:justify-between md:items-center gap-6">
            <a href="{{ route('etudiant.logements.index') }}"
               class="inline-block w-full md:w-auto text-center bg-gray-700 hover:bg-gray-900 text-white font-semibold px-6 py-3 rounded-lg transition-all duration-300">
                ← Retour à l’accueil
            </a>

            <div class="flex flex-col gap-3 w-full md:w-auto">
                @php
                    // Récupérer la dernière réservation de l'étudiant pour ce logement
                    $reservation = $logement->reservations()
                        ->where('etudiant_id', auth()->id())
                        ->latest()
                        ->first();

                    // Vérifier si une avance a été payée pour cette réservation
                    $avancePayee = $reservation && $reservation->paiements
                        ->where('type', 'avance')
                        ->where('statut', 'payé')
                        ->isNotEmpty();

                    // Vérifier si le logement est déjà réservé (approuvé) par un autre étudiant
                    $estReserveParAutre = $logement->reservations()
                        ->where('statut', 'approuvée')
                        ->where('etudiant_id', '!=', auth()->id())
                        ->exists();
                @endphp

                @if ($estReserveParAutre)
                    <div class="bg-red-600 text-white px-6 py-3 rounded-lg text-center font-semibold">
                        🔒 Indisponible
                    </div>

                @else
                    @if (!$reservation || in_array($reservation->statut, ['rejetée', 'annulée']))
                        <a href="{{ route('etudiant.reservations.create', $logement) }}"
                           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg text-center font-medium transition-all duration-300">
                            📅 Réserver ce logement
                        </a>
                    @elseif ($reservation->statut === 'approuvée')
                        <a href="{{ route('colocations.create', $reservation->id) }}"
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-lg text-center font-medium transition-all duration-300">
                            🤝 Rechercher un colocataire
                        </a>
                        @if ($avancePayee)
                            <div class="bg-green-600 text-white px-6 py-3 rounded-lg text-center font-semibold">
                                🏠 Déjà loué
                            </div>
                            <a href="{{ route('etudiants.maintenance.create', $reservation->id) }}"
                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-lg text-center font-medium transition-all duration-300">
                                🛠️ Demander maintenance
                            </a>
                        @else
                            <div class="bg-gray-200 text-gray-600 px-6 py-3 rounded-lg text-center">
                                🔒 Réservé
                            </div>
                        @endif
                    @else
                        <div class="bg-gray-200 text-gray-600 px-6 py-3 rounded-lg text-center">
                            🔒 Déjà réservé
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>

{{-- AVIS DES ÉTUDIANTS --}}
@if($avis->count())
    <div class="mt-10 bg-white rounded-2xl shadow-lg p-8 max-w-6xl mx-auto">
        <h2 class="text-2xl font-semibold text-gray-700 mb-6">Avis des étudiants</h2>
        <div class="space-y-6">
            @foreach($avis as $commentaire)
                <div class="border-b border-gray-200 pb-4">
                    <p class="text-gray-800 font-medium">{{ $commentaire->auteur->name }}</p>
                    <p class="text-gray-600 italic mt-1">{{ $commentaire->commentaire }}</p>
                </div>
            @endforeach
        </div>
    </div>
@endif

@endsection
