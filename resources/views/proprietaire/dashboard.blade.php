@extends('layouts.proprietaire')

@section('title', 'Tableau de bord')

@section('content')
<!-- Barre de navigation -->
<nav class="bg-blue-700 text-white px-6 py-4 shadow-md">
    <div class="flex justify-between items-center">
        <!-- Logo / Lien gauche -->
        <div>
            <a href="{{ route('proprietaire.dashboard') }}" class="text-xl font-bold hover:underline">CampusHome</a>
        </div>

        <!-- Liens de navigation droite -->
        <div class="flex items-center space-x-4">
            <a href="{{ route('proprietaire.logements.index') }}" class="hover:underline">Mes logements</a>
            <a href="{{ route('proprietaire.reservations.index') }}" class="hover:underline">Réservations</a>
            <a href="{{ route('proprietaire.messages') }}" class="hover:underline">Messagerie</a>
            
            <!-- Déconnexion -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition">
                    Déconnexion
                </button>
            </form>
        </div>
    </div>
</nav>

<div class="p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Bienvenue, {{ Auth::user()->name }}</h2>

    <!-- Résumé Statistique -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Logements validés -->
        <div class="bg-white p-5 rounded-lg shadow-md">
            <h3 class="text-sm text-gray-500">Logements publiés et validés</h3>
            <p class="text-3xl font-semibold text-blue-600">{{ $logementsValides->count() }}</p>
        </div>
    
        <!-- Logements en attente -->
        <div class="bg-white p-5 rounded-lg shadow-md">
            <h3 class="text-sm text-gray-500">Logements en attente</h3>
            <p class="text-3xl font-semibold text-yellow-500">{{ $logementsEnAttente->count() }}</p>
        </div>
    
        <!-- Logements non validés -->
        <div class="bg-white p-5 rounded-lg shadow-md">
            <h3 class="text-sm text-gray-500">Logements non validés</h3>
            <p class="text-3xl font-semibold text-red-500">{{ $logementsNonValidés->count() }}</p>
        </div>
    </div>

    <!-- Liste des logements -->
    <h3 class="text-xl font-semibold text-gray-700 mb-4">Mes logements</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($logements as $logement)
        <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
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

            {{-- Détails du logement --}}
            <div class="p-4">
                <h4 class="font-bold text-lg text-gray-800">{{ $logement->titre }}</h4>
                <p class="text-sm text-gray-600">{{ $logement->adresse }}</p>
                <p class="mt-2 text-blue-600 font-semibold">{{ number_format($logement->loyer, 0, ',', ' ') }} FCFA / mois</p>
                <div class="mt-2 text-sm text-gray-600">
                    <strong>Propriétaire :</strong> {{ $logement->proprietaire->name }}<br>
                    <strong>Téléphone :</strong> {{ $logement->proprietaire->phone ?? 'Non renseigné' }}
                </div>
                
                <div class="mt-2 text-gray-700 text-sm">
                    <strong>Description :</strong>
                    <p>{{ $logement->description }}</p>
                </div>
                
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

   <!-- Section Avis -->
    <div class="mt-10 bg-white p-6 rounded-lg shadow">
        <h4 class="text-lg font-semibold text-gray-800 mb-4">Avis sur mes logements</h4>
        @foreach($avis as $avis)
            <div class="avis mb-4 p-4 border-b">
                <p><strong>{{ $avis->auteur->name }}</strong> a donné une note de {{ $avis->note }}.</p>
                <p>{{ $avis->commentaire }}</p>
                <p>Réservé le : {{ $avis->reservation->created_at->format('d-m-Y') }}</p>
                <p>Status : {{ $avis->verifie ? 'Vérifié' : 'Non vérifié' }}</p>
            </div>
        @endforeach

        @if($avis->isEmpty())
            <p>Aucun avis pour l’instant.</p>
        @endif
    </div>

    <!-- Notifications et maintenance -->
    <div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Notifications -->
        <div class="bg-white p-4 rounded-lg shadow">
            <h4 class="text-lg font-semibold text-gray-800 mb-3">Notifications récentes</h4>
            <ul class="text-sm text-gray-600 space-y-2">
                @forelse($notificationsMessages as $notification)
                    <li class="flex justify-between items-center {{ is_null($notification->read_at) ? 'font-semibold text-black' : '' }}">
                        <a href="{{ route('notifications.lire', $notification->id) }}" class="hover:text-blue-600">
                            {{ $notification->data['message'] ?? 'Nouvelle notification' }}
                        </a>
                        <span class="text-xs text-gray-400">
                            {{ $notification->created_at->diffForHumans() }}
                        </span>
                    </li>
                @empty
                    <li>Aucune notification pour l’instant.</li>
                @endforelse
            </ul>
        </div>

        <!-- Demandes de maintenance -->
        <div class="bg-white p-4 rounded-lg shadow">
            <h4 class="text-lg font-semibold text-gray-800 mb-3">Demandes de maintenance</h4>
            <ul class="text-sm text-gray-600 space-y-2">
                @forelse($demandesMaintenance as $demande)
                    <li>
                        {{ $demande->etudiant->name }} demande une intervention 
                        <strong>{{ $demande->urgence }}</strong> pour le logement 
                        <strong>{{ $demande->logement->titre }}</strong> :
                        "{{ Str::limit($demande->description, 60) }}"
                        <span class="italic text-xs text-gray-500">[Statut: {{ $demande->statut }}]</span>
                    </li>
                @empty
                    <li>Aucune demande récente.</li>
                @endforelse
            </ul>
        </div>

    </div>

</div>
@endsection
