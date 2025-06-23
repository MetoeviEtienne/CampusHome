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
