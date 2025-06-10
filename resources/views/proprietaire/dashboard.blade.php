@extends('layouts.proprietaire')

@section('title', 'Tableau de bord')

@section('content')
<!-- Barre de navigation -->
{{-- <nav class="bg-gradient-to-r from-blue-700 to-blue-900 text-white px-4 py-4 shadow-lg sticky top-0 z-50">
    <div class="flex justify-between items-center max-w-7xl mx-auto">
        <!-- Logo -->
        <a href="{{ route('proprietaire.dashboard') }}" class="text-2xl font-extrabold tracking-wide hover:underline">
            CampusHome
        </a>

        <!-- Hamburger (mobile) -->
        <button class="md:hidden text-white text-3xl focus:outline-none" onclick="toggleProprioMenu()">
            ☰
        </button>

        <!-- Liens de navigation (desktop) -->
        <div id="proprio-nav-desktop" class="hidden md:flex items-center space-x-6 text-sm font-medium">
            <a href="{{ route('proprietaire.logements.index') }}" class="hover:text-gray-300 transition">Mes logements</a>
            <a href="{{ route('proprietaire.reservations.index') }}" class="hover:text-gray-300 transition">Réservations</a>
            <a href="{{ route('proprietaire.messages') }}" class="hover:text-gray-300 transition">Messagerie</a>

            <!-- Déconnexion -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                        class="bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-400 focus:outline-none 
                               text-white px-4 py-2 rounded-lg shadow transition font-semibold">
                    Déconnexion
                </button>
            </form>
        </div>
    </div>

    <!-- Mobile Nav -->
    <div id="proprio-nav-mobile" class="md:hidden hidden flex-col space-y-3 px-4 pt-4 text-sm font-medium">
        <a href="{{ route('proprietaire.logements.index') }}" class="block hover:text-gray-300">Mes logements</a>
        <a href="{{ route('proprietaire.reservations.index') }}" class="block hover:text-gray-300">Réservations</a>
        <a href="{{ route('proprietaire.messages') }}" class="block hover:text-gray-300">Messagerie</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" 
                    class="bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-400 focus:outline-none 
                           text-white w-full py-2 rounded-lg shadow transition font-semibold">
                Déconnexion
            </button>
        </form>
    </div>
</nav>

<script>
    function toggleProprioMenu() {
        document.getElementById('proprio-nav-mobile').classList.toggle('hidden');
    }
</script> --}}

<div class="max-w-7xl mx-auto p-6 space-y-10">

    <h2 class="text-3xl font-extrabold text-gray-900">Bienvenue, <span class="text-blue-700">{{ Auth::user()->name }}</span></h2>

    <!-- Résumé Statistique -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white rounded-xl shadow-md p-6 flex flex-col items-center space-y-2 hover:shadow-xl transition">
            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Logements publiés et validés</h3>
            <p class="text-4xl font-extrabold text-blue-600">{{ $logementsValides->count() }}</p>
            <svg class="w-10 h-10 text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h1l3-3 4 4 3-3 5 5v5H3z"></path></svg>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 flex flex-col items-center space-y-2 hover:shadow-xl transition">
            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Logements en attente</h3>
            <p class="text-4xl font-extrabold text-yellow-500">{{ $logementsEnAttente->count() }}</p>
            <svg class="w-10 h-10 text-yellow-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3"></path></svg>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 flex flex-col items-center space-y-2 hover:shadow-xl transition">
            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Logements non validés</h3>
            <p class="text-4xl font-extrabold text-red-600">{{ $logementsNonValidés->count() }}</p>
            <svg class="w-10 h-10 text-red-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
        </div>
    </div>

    <!-- Liste des logements -->
    <section>
        <h3 class="text-2xl font-semibold text-gray-800 mb-6 border-b border-gray-300 pb-2">Mes logements</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($logements as $logement)
            <article class="bg-white rounded-xl shadow hover:shadow-xl transition overflow-hidden flex flex-col">
                {{-- Photos --}}
                @if ($logement->photos->isNotEmpty())
                <div class="grid grid-cols-3 gap-1 p-3 bg-gray-50">
                    @foreach($logement->photos as $photo)
                        <a href="{{ asset('storage/' . $photo->chemin) }}" target="_blank" class="block overflow-hidden rounded">
                            <img src="{{ asset('storage/' . $photo->chemin) }}" alt="Photo"
                                 class="h-24 w-full object-cover hover:scale-105 transition-transform duration-300" />
                        </a>
                    @endforeach
                </div>
                @else
                <div class="h-48 bg-gray-100 flex items-center justify-center text-gray-400 italic">
                    Aucune image disponible
                </div>
                @endif

                {{-- Details --}}
                <div class="p-5 flex flex-col flex-grow">
                    <h4 class="font-bold text-lg text-gray-900 truncate">{{ $logement->titre }}</h4>
                    <p class="text-sm text-gray-600 truncate">{{ $logement->adresse }}</p>
                    <p class="text-sm text-gray-600 truncate">{{ $logement->quartier }}</p>
                    <p class="mt-2 text-blue-700 font-semibold text-lg">
                        {{ number_format($logement->loyer, 0, ',', ' ') }} FCFA / mois
                    </p>

                    <div class="mt-2 text-sm text-gray-700 space-y-1 flex-grow">
                        <p><strong>Numero de la maison :</strong> {{ $logement->numMaison }}</p>
                        <p><strong>Numero de la chambre :</strong> {{ $logement->numChambre }}</p>
                        <p><strong>Propriétaire :</strong> {{ $logement->proprietaire->name }}</p>
                        <p><strong>Téléphone :</strong> {{ $logement->proprietaire->phone ?? 'Non renseigné' }}</p>
                        <p><strong>Description :</strong> <span class="block mt-1 text-gray-600 leading-relaxed">{{ Str::limit($logement->description, 120) }}</span></p>
                    </div>

                    <div class="mt-3">
                        @if($logement->valide)
                            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                Publié
                            </span>
                        @elseif($logement->etat === 'rejeté')
                            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                Rejeté
                            </span>
                        @else
                            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                En attente
                            </span>
                        @endif
                    </div>

                    <div class="mt-4 flex justify-between items-center text-sm text-blue-600 font-medium">
                        <a href="{{ route('proprietaire.logements.edit', $logement) }}" class="hover:underline focus:outline-none focus:ring-2 focus:ring-blue-400 rounded">
                            Modifier
                        </a>
                        <form action="{{ route('proprietaire.logements.destroy', $logement) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline focus:outline-none focus:ring-2 focus:ring-red-400 rounded">
                                Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
    </section>

    <!-- Avis -->
    <section class="bg-white p-6 rounded-xl shadow-md">
        <h4 class="text-xl font-semibold text-gray-900 mb-5 border-b border-gray-200 pb-2">Avis sur mes logements</h4>

        @if($avis->isEmpty())
            <p class="text-gray-600 italic">Aucun avis pour l’instant.</p>
        @else
            <ul class="space-y-4 max-h-64 overflow-y-auto pr-4">
                @foreach($avis as $item)
                <li class="border-b border-gray-200 pb-3">
                    <p>
                        <strong class="text-blue-700">{{ $item->auteur->name }}</strong> — 
                        <span class="text-gray-500 text-xs">{{ $item->created_at->format('d/m/Y à H:i') }}</span>  
                        — Note : <span class="font-semibold">{{ $item->note }}</span>
                    </p>
                    <p class="mt-1 text-gray-700">{{ $item->commentaire }}</p>
                </li>
                @endforeach
            </ul>
        @endif
    </section>

    <!-- Notifications & Maintenance -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <!-- Notifications -->
        <section class="bg-white p-6 rounded-xl shadow-md">
            <h4 class="text-xl font-semibold text-gray-900 mb-4 border-b border-gray-200 pb-2">Notifications récentes</h4>
            <ul class="text-sm text-gray-700 space-y-3 max-h-72 overflow-y-auto pr-2">
                @forelse($notificationsMessages as $notification)
                    <li class="flex justify-between items-center space-x-3
                               {{ is_null($notification->read_at) ? 'font-semibold text-gray-900' : 'text-gray-500' }}">
                        <a href="{{ route('notifications.lire', $notification->id) }}" class="hover:text-blue-600 flex-grow truncate">
                            {{ $notification->data['message'] ?? 'Nouvelle notification' }}
                        </a>
                        <span class="text-xs text-gray-400 whitespace-nowrap ml-2">
                            {{ $notification->created_at->diffForHumans() }}
                        </span>
                    </li>
                @empty
                    <li class="text-gray-600 italic">Aucune notification pour l’instant.</li>
                @endforelse
            </ul>
        </section>

        <!-- Demandes de maintenance -->
        <section class="bg-white p-6 rounded-xl shadow-md">
            <h4 class="text-xl font-semibold text-gray-900 mb-4 border-b border-gray-200 pb-2">Demandes de maintenance</h4>
            <ul class="text-sm text-gray-700 space-y-3 max-h-72 overflow-y-auto pr-2">
                @forelse($demandesMaintenance as $demande)
                    <li class="truncate">
                        <span class="font-semibold text-blue-700">{{ $demande->etudiant->name }}</span> demande une intervention 
                        <strong class="text-yellow-600">{{ $demande->urgence }}</strong> pour le logement 
                        <strong class="text-gray-800">{{ $demande->logement->titre }}</strong> :
                        "{{ Str::limit($demande->description, 60) }}"
                        <span class="italic text-xs text-gray-400 ml-1">[Statut: {{ ucfirst($demande->statut) }}]</span>
                    </li>
                @empty
                    <li class="text-gray-600 italic">Aucune demande récente.</li>
                @endforelse
            </ul>
        </section>

    </div>

</div>
@endsection
