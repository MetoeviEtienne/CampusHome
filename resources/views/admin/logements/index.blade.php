@extends('layouts.admin')

@section('title', 'Logements à valider')

@section('content')
<div class="container mx-auto p-6 max-w-7xl">
    <h2 class="text-3xl font-extrabold mb-8 text-center text-gray-800">
        Logements à valider
    </h2>

    @if($logements->isEmpty())
        <p class="text-center text-gray-500 text-lg mt-10">Aucun logement en attente de validation.</p>
    @else
        <div class="grid gap-8 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
            @foreach($logements as $logement)
                <article class="bg-white rounded-xl shadow-md hover:shadow-lg transition p-5 flex flex-col">
                    <h3 class="text-xl font-semibold mb-4 truncate" title="{{ $logement->titre }}">
                        {{ $logement->titre }}
                    </h3>

                    <!-- Photos scrollables -->
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

                    <div class="flex flex-col gap-1 text-gray-700 text-sm mb-4 flex-grow">
                        <p><span class="font-semibold">Adresse :</span> {{ $logement->adresse }}</p>
                        <p><span class="font-semibold">Type :</span> {{ ucfirst($logement->type) }}</p>
                        <p><span class="font-semibold">Loyer :</span> {{ number_format($logement->loyer, 0, ',', ' ') }} FCFA</p>
                        <p><span class="font-semibold">Propriétaire :</span> {{ $logement->proprietaire->name }}</p>

                        <p>
                            <span class="font-semibold">Pièce d'identité :</span>
                            @if($logement->piece_identite_path)
                                <a href="{{ asset('storage/' . $logement->piece_identite_path) }}" target="_blank" class="text-blue-600 underline hover:text-blue-800">
                                    Voir le document
                                </a>
                            @else
                                <span class="text-gray-400 italic">Non disponible</span>
                            @endif
                        </p>

                        <p>
                            <span class="font-semibold">Titre de propriété :</span>
                            @if($logement->titre_propriete_path)
                                <a href="{{ asset('storage/' . $logement->titre_propriete_path) }}" target="_blank" class="text-blue-600 underline hover:text-blue-800">
                                    Voir le document
                                </a>
                            @else
                                <span class="text-gray-400 italic">Non disponible</span>
                            @endif
                        </p>
                    </div>

                    <div class="flex gap-3 mt-auto">
                        <form method="POST" action="{{ route('admin.logements.valider', $logement) }}" class="flex-grow">
                            @csrf
                            <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-lg font-semibold hover:bg-green-700 transition">
                                ✅ Valider
                            </button>
                        </form>

                        <form method="POST" action="{{ route('admin.logements.rejecter', $logement) }}" class="flex-grow">
                            @csrf
                            <button type="submit" class="w-full bg-red-600 text-white py-2 rounded-lg font-semibold hover:bg-red-700 transition">
                                ❌ Rejeter
                            </button>
                        </form>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="mt-10 flex justify-center">
            {{ $logements->links() }}
        </div>
    @endif
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
