@extends('layouts.naveshow')

@section('title', 'Détails du logement')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10 sm:px-6 lg:px-8">
    {{-- Titre --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900">
            <i class="fas fa-house mr-2 text-indigo-600"></i>{{ $logement->titre }}
        </h1>
        <span class="mt-2 md:mt-0 bg-blue-100 text-blue-700 px-4 py-2 rounded-lg text-sm font-medium shadow flex items-center gap-2">
            <i class="fas fa-door-open"></i> Chambre N° {{ $logement->numChambre }}
        </span>
    </div>

    {{-- Galerie --}}
    <div class="bg-white rounded-3xl overflow-hidden shadow mb-10">
        @if($logement->photos->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-4">
                @foreach($logement->photos as $photo)
                    <img src="{{ asset('storage/' . $photo->chemin) }}"
                         class="w-full h-80 object-cover rounded-xl transition-transform hover:scale-105 duration-300"
                         alt="Photo logement">
                @endforeach
            </div>
        @else
            <div class="h-64 flex items-center justify-center bg-gray-100 text-gray-500">
                <i class="fas fa-image text-4xl mr-3"></i> Aucune photo disponible
            </div>
        @endif
    </div>

    {{-- Détails Logement --}}
    <div class="grid md:grid-cols-2 gap-8 bg-white rounded-3xl p-8 shadow">
        <div class="space-y-4 text-gray-700">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">
                <i class="fas fa-info-circle text-indigo-500 mr-2"></i> Informations générales
            </h2>
            <p><i class="fas fa-map-pin text-gray-500 mr-2"></i><strong>Ville :</strong> {{ $logement->adresse }}</p>
            <p><i class="fas fa-location-dot text-gray-500 mr-2"></i><strong>Quartier :</strong> {{ $logement->quartier }}</p>
            <p><i class="fas fa-ruler-combined text-gray-500 mr-2"></i><strong>Superficie :</strong> {{ $logement->superficie }} m²</p>
            <p><i class="fas fa-home text-gray-500 mr-2"></i><strong>Type :</strong> {{ ucfirst($logement->type) }}</p>
            <p><i class="fas fa-money-bill-wave text-gray-500 mr-2"></i><strong>Loyer :</strong> <span class="text-green-600 font-bold">{{ number_format($logement->loyer, 0, ',', ' ') }} FCFA</span> / mois</p>
            <p><i class="fas fa-calendar-alt text-gray-500 mr-2"></i><strong>Disponible à partir du :</strong> {{ \Carbon\Carbon::parse($logement->disponibilite)->format('d/m/Y') }}</p>
        </div>

        {{-- Profil Propriétaire --}}
        <div class="bg-gray-50 border border-gray-200 rounded-2xl p-6 shadow-sm">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">
                <i class="fas fa-user text-indigo-500 mr-2"></i> Propriétaire
            </h2>
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center text-xl text-gray-600">
                    {{ strtoupper(substr($logement->proprietaire->name, 0, 1)) }}
                </div>
                <div>
                    <p class="font-semibold text-gray-800"><i class="fas fa-user-circle mr-1"></i> {{ $logement->proprietaire->name }}</p>
                    <p class="text-sm text-gray-600"><i class="fas fa-phone-alt mr-1"></i> {{ $logement->proprietaire->phone }}</p>
                </div>
            </div>
            <p class="mt-4"><i class="fas fa-house-user mr-2"></i><strong>Numéro de maison :</strong> {{ $logement->numMaison }}</p>
        </div>
    </div>

    {{-- Description --}}
    <div class="mt-10 bg-white rounded-3xl shadow p-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">
            <i class="fas fa-file-alt text-indigo-500 mr-2"></i> Description
        </h2>
        <p class="text-gray-700 leading-relaxed text-justify">
            {{ $logement->description }}
        </p>
    </div>

    {{-- Actions --}}
    <div class="mt-10 flex flex-col md:flex-row justify-between items-center gap-4">
        <a href="{{ route('etudiant.logements.index') }}"
           class="w-full md:w-auto text-center bg-gray-800 hover:bg-gray-900 text-white font-semibold px-6 py-3 rounded-xl shadow transition duration-300 flex items-center justify-center gap-2">
            <i class="fas fa-arrow-left"></i> ← Retour
        </a>

        @php
            $reservation = $logement->reservations()->where('etudiant_id', auth()->id())->latest()->first();
            $avancePayee = $reservation && $reservation->paiements->where('type', 'avance')->where('statut', 'payé')->isNotEmpty();
            $estReserveParAutre = $logement->reservations()->where('statut', 'approuvée')->where('etudiant_id', '!=', auth()->id())->exists();
        @endphp

        <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
            @if ($estReserveParAutre)
                <div class="w-full text-center bg-red-600 text-white px-6 py-3 rounded-xl font-semibold flex items-center justify-center gap-2">
                    <i class="fas fa-lock"></i> Indisponible
                </div>
            @else
                @if (!$reservation || in_array($reservation->statut, ['rejetée', 'annulée']))
                    <a href="{{ route('etudiant.reservations.create', $logement) }}"
                       class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl text-center font-medium transition flex items-center justify-center gap-2">
                        <i class="fas fa-calendar-check"></i> Réserver
                    </a>
                @elseif ($reservation->statut === 'approuvée')
                    <a href="{{ route('colocations.create', $reservation->id) }}"
                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-xl font-medium text-center transition flex items-center justify-center gap-2">
                        <i class="fas fa-handshake"></i> Chercher colocataire
                    </a>
                    @if ($avancePayee)
                        <div class="bg-green-600 text-white px-6 py-3 rounded-xl text-center font-semibold flex items-center justify-center gap-2">
                            <i class="fas fa-check-circle"></i> Logement payé
                        </div>
                        <a href="{{ route('etudiants.maintenance.create', $reservation->id) }}"
                           class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-xl text-center font-medium transition flex items-center justify-center gap-2">
                            <i class="fas fa-tools"></i> Maintenance
                        </a>
                    @else
                        <div class="bg-gray-200 text-gray-600 px-6 py-3 rounded-xl text-center flex items-center justify-center gap-2">
                            <i class="fas fa-lock"></i> Réservé
                        </div>
                    @endif
                @else
                    <div class="bg-gray-200 text-gray-600 px-6 py-3 rounded-xl text-center flex items-center justify-center gap-2">
                        <i class="fas fa-lock"></i> Déjà réservé
                    </div>
                @endif
            @endif
        </div>
    </div>

    {{-- Avis étudiants --}}
    @if($avis->count())
        <div class="mt-12 bg-white rounded-3xl shadow p-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">
                <i class="fas fa-comments text-indigo-500 mr-2"></i> Avis des étudiants
            </h2>
            <div class="space-y-6">
                @foreach($avis as $commentaire)
                    <div class="border-b border-gray-200 pb-4">
                        <p class="text-gray-900 font-semibold">
                            <i class="fas fa-user-circle mr-1"></i> {{ $commentaire->auteur->name }}
                        </p>
                        <p class="text-gray-600 italic mt-1">{{ $commentaire->created_at->format('d/m/Y') }}</p>
                        <p class="text-gray-700 mt-2">{{ $commentaire->texte }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
