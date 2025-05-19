@extends('layouts.etudiant')

@section('title', 'Logements disponibles')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4">

    {{-- Présentation des logements --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        @forelse($logements as $logement)
            <div class="bg-white rounded shadow overflow-hidden flex flex-col max-w-md mx-auto w-full">
                @if($logement->photos->isNotEmpty())
                    <div class="grid grid-cols-3 gap-1 p-2 bg-gray-100">
                        @foreach($logement->photos as $photo)
                            <a href="{{ asset('storage/' . $photo->chemin) }}" target="_blank">
                                <img 
                                    src="{{ asset('storage/' . $photo->chemin) }}" 
                                    alt="Photo" 
                                    class="h-32 sm:h-40 w-full object-cover rounded hover:opacity-80 transition duration-200"
                                    loading="lazy"
                                >
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                        Aucune image disponible
                    </div>
                @endif

                <div class="p-4 flex flex-col flex-grow">
                    <h2 class="text-lg font-semibold">{{ $logement->adresse }}</h2>
                    <p class="text-sm text-gray-600">{{ ucfirst($logement->type) }} - {{ $logement->superficie }} m²</p>
                    <p class="text-blue-600 font-bold mt-2">{{ number_format($logement->loyer, 0, ',', ' ') }} FCFA/mois</p>

                    @if ($logement->estDejaReserve ?? false)
                        <p class="text-red-600 font-semibold mt-2">Déjà réservé</p>
                    @endif

                    <div class="mt-auto mt-3 flex flex-wrap gap-3">
                        <a href="{{ route('etudiant.logements.show', $logement) }}"
                           class="text-sm text-white bg-blue-600 px-4 py-2 rounded hover:bg-blue-700">
                            Voir détails
                        </a>
                        <a href="{{ route('etudiant.logements.avis', $logement->id) }}"
                           class="text-sm text-white bg-gray-600 px-4 py-2 rounded hover:bg-gray-700">
                            Donner un avis
                        </a>
                        <a href="{{ route('etudiants.messages.conversation', ['proprietaireId' => $logement->proprietaire_id]) }}" 
                           class="inline-block text-sm text-white bg-yellow-600 px-4 py-2 rounded hover:bg-yellow-700 transition-colors duration-200">
                            Discuter
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-500">Aucun logement disponible pour le moment.</p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $logements->links() }}
    </div>
</div>
<div class="max-w-7xl mx-auto py-8 px-4">
    {{-- <h1 class="text-2xl font-bold mb-6">Logements disponibles</h1> --}}

    {{-- Présentation des logements --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        @forelse($logements as $logement)
            <!-- ta carte logement -->
        @empty
            <p class="text-gray-500">Aucun logement disponible pour le moment.</p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $logements->links() }}
    </div>
</div>

{{-- Footer --}}
<footer class="bg-blue-600 text-white mt-12">
  <div class="max-w-7xl mx-auto px-6 py-10 grid grid-cols-1 sm:grid-cols-3 gap-8">

    <!-- À propos -->
    <div>
      <h3 class="text-xl font-bold mb-4">CampusHome</h3>
      <p class="text-sm opacity-80">
        Votre plateforme pour gérer facilement vos logements et réservations.  
        Simple, rapide, et sécurisée.
      </p>
    </div>

    <!-- Liens rapides -->
    <div>
      <h4 class="text-lg font-semibold mb-4">Liens rapides</h4>
      <ul class="space-y-2">
        <li><a href="{{ route('dashboard') }}" class="hover:underline hover:text-gray-200">Accueil</a></li>
        <li><a href="{{ route('etudiant.logements.index') }}" class="hover:underline hover:text-gray-200">Logements</a></li>
        <li><a href="{{ route('etudiant.reservations.index') }}" class="hover:underline hover:text-gray-200">Mes réservations</a></li>
        <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-footer').submit();" class="hover:underline hover:text-gray-200 cursor-pointer">Déconnexion</a></li>
      </ul>
      <form id="logout-form-footer" method="POST" action="{{ route('logout') }}" class="hidden">@csrf</form>
    </div>

    <!-- Contact -->
    <div>
      <h4 class="text-lg font-semibold mb-4">Contactez-nous</h4>
      <p class="text-sm opacity-80">123 Rue de l'Université<br>Ville, Pays</p>
      <p class="mt-2 text-sm opacity-80">Email : contact@campushome.com</p>
      <p class="mt-1 text-sm opacity-80">Téléphone : +229 00 00 00 00</p>
    </div>

  </div>

  <div class="border-t border-blue-500 mt-8 py-4 text-center text-sm opacity-70">
    &copy; {{ date('Y') }} CampusHome. Tous droits réservés.
  </div>
</footer>

@endsection
