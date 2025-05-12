@extends('layouts.proprietaire')

@section('title', 'Tableau de bord')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Bienvenue, {{ Auth::user()->name }}</h2>

    <!-- Résumé Statistique -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-5 rounded-lg shadow-md">
            <h3 class="text-sm text-gray-500">Logements publiés</h3>
            <p class="text-3xl font-semibold text-blue-600">{{ $logements->where('valide', true)->count() }}</p>
        </div>
        <div class="bg-white p-5 rounded-lg shadow-md">
            <h3 class="text-sm text-gray-500">Réservations en attente</h3>
            {{-- <p class="text-3xl font-semibold text-yellow-500">{{ $reservationsEnAttenteCount }}</p> --}}
        </div>
        <div class="bg-white p-5 rounded-lg shadow-md">
            <h3 class="text-sm text-gray-500">Notifications</h3>
            {{-- <p class="text-3xl font-semibold text-red-500">{{ $notificationsCount }}</p> --}}
        </div>
    </div>

    <!-- Boutons d'action -->
    <div class="mb-6 flex flex-wrap gap-4">
        <a href="{{ route('proprietaire.logements.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 transition">+ Ajouter un logement</a>
        <a href="{{ route('proprietaire.reservations.index') }}" class="bg-yellow-500 text-white px-4 py-2 rounded shadow hover:bg-yellow-600 transition">Voir les réservations</a>
        <a href="{{ route('proprietaire.messages') }}" class="bg-gray-600 text-white px-4 py-2 rounded shadow hover:bg-gray-700 transition">Messagerie</a>
    </div>

    <!-- Liste des logements -->
    <h3 class="text-xl font-semibold text-gray-700 mb-4">Mes logements</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($logements as $logement)
        <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
            <img src="{{ $logement->photos->isNotEmpty() ? asset('storage/' . $logement->photos->first()->chemin) : 'https://via.placeholder.com/400x200' }}" alt="Image logement" class="w-full h-48 object-cover">
            <div class="p-4">
                <h4 class="font-bold text-lg text-gray-800">{{ $logement->titre }}</h4>
                <p class="text-sm text-gray-600">{{ $logement->adresse }}</p>
                <p class="mt-2 text-blue-600 font-semibold">{{ number_format($logement->loyer, 0, ',', ' ') }} FCFA / mois</p>
                <div class="mt-2">
                    <span class="text-xs {{ $logement->valide ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }} px-2 py-1 rounded-full">
                        {{ $logement->valide ? 'Publié' : 'En attente' }}
                    </span>
                </div>
                <div class="mt-4 flex justify-between text-sm text-blue-500">
                    <a href="{{ route('proprietaire.logements.edit', $logement) }}" class="hover:underline">Modifier</a>
                    <form action="{{ route('proprietaire.logements.destroy', $logement) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Notifications et maintenance -->
    <div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Notifications -->
        <div class="bg-white p-4 rounded-lg shadow">
            <h4 class="text-lg font-semibold text-gray-800 mb-3">Notifications récentes</h4>
            <ul class="text-sm text-gray-600 space-y-2">
                {{-- @foreach($notifications as $notification)
                    <li>{{ $notification->message }}</li>
                @endforeach --}}
            </ul>
        </div>

        <!-- Demandes de maintenance -->
        <div class="bg-white p-4 rounded-lg shadow">
            <h4 class="text-lg font-semibold text-gray-800 mb-3">Demandes de maintenance</h4>
            <ul class="text-sm text-gray-600 space-y-2">
                {{-- @foreach($demandesMaintenance as $demande)
                    <li>{{ $demande->type }} - {{ $demande->logement->titre }}</li>
                @endforeach --}}
            </ul>
        </div>
    </div>
</div>
@endsection
