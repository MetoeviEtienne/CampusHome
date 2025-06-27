@extends('layouts.admin')

@section('title', 'Historique des logements validés et rejetés')

@section('content')
<div class="container mx-auto p-6 max-w-7xl">

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <h2 class="text-3xl font-extrabold mb-8 text-center text-gray-800">
        Historique des logements validés ou rejetés
    </h2>

        <div class="mb-6 text-right">
            <form action="{{ route('admin.logements.historique.vider') }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment vider l’historique ?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded-lg shadow">
                    Vider l'historique
                </button>
            </form>
        </div>

    @forelse($proprietaires as $proprietaire)
        <section class="mb-12">
            <h3 class="text-2xl font-semibold text-blue-700 mb-6 border-b border-blue-300 pb-2">
                Propriétaire : {{ $proprietaire->name }}
            </h3>

            <div class="grid gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                @foreach($proprietaire->logements as $logement)
                    <article class="bg-white rounded-xl shadow-md hover:shadow-lg transition p-5 flex flex-col">
                        
                        <h4 class="text-xl font-semibold mb-3 truncate" title="{{ $logement->titre }}">
                            {{ $logement->titre }}
                        </h4>

                        <!-- Carrousel photos scrollable -->
                        <div class="flex space-x-3 overflow-x-auto mb-4 no-scrollbar">
                            @foreach($logement->photos as $photo)
                                <img 
                                    src="{{ asset('storage/' . $photo->chemin) }}" 
                                    alt="Photo du logement" 
                                    class="w-28 h-28 object-cover rounded-lg flex-shrink-0"
                                    loading="lazy"
                                >
                            @endforeach
                        </div>

                        <div class="flex flex-col gap-1 flex-grow text-gray-700 text-sm">
                            <p><span class="font-semibold">Adresse :</span> {{ $logement->adresse }}</p>
                            <p><span class="font-semibold">Quartier :</span> {{ $logement->quartier }}</p>
                            <p><span class="font-semibold">Type :</span> {{ ucfirst($logement->type) }}</p>
                            <p><span class="font-semibold">Loyer :</span> {{ number_format($logement->loyer, 0, ',', ' ') }} FCFA</p>
                            <p><span class="font-semibold">Numero de la Chambre :</span> {{ $logement->numChambre }}</p>
                            <p><span class="font-semibold">Numero de la maison :</span> {{ $logement->numMaison }}</p>
                        </div>

                        <div class="mt-4">
                            <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                                {{ $logement->valide ? 'bg-green-100 text-green-800' : ($logement->etat === 'rejeté' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-700') }}">
                                @if($logement->valide)
                                    Validé
                                @elseif($logement->etat === 'rejeté')
                                    Rejeté
                                @else
                                    Inconnu
                                @endif
                            </span>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    @empty
        <p class="text-center text-gray-500 text-lg mt-10">Aucun logement validé ou rejeté pour le moment.</p>
    @endforelse
</div>

<style>
  /* Masquer la scrollbar mais garder le scroll */
  .no-scrollbar::-webkit-scrollbar {
    display: none;
  }
  .no-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
  }
</style>
@endsection
