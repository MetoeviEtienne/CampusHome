@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h2 class="text-3xl font-bold mb-8 text-gray-800">Tous les signalements de maintenance</h2>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded shadow-sm border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    @if($demandes->isEmpty())
        <p class="text-center text-gray-500 italic py-8">Aucun signalement trouvé.</p>
    @else
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($demandes as $demande)
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-6 flex flex-col justify-between">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 truncate" title="{{ $demande->logement->titre }}">
                            {{ $demande->logement->titre }}
                        </h3>
                        <p class="text-sm text-gray-600 mt-1">
                            <span class="font-semibold">Propriétaire :</span> {{ $demande->logement->proprietaire->name ?? 'N/A' }}
                        </p>
                        <p class="text-sm text-gray-600">
                            <span class="font-semibold">Étudiant :</span> {{ $demande->etudiant->name }}
                        </p>
                        <p class="mt-3 text-gray-700 line-clamp-4" title="{{ $demande->description }}">
                            {{ $demande->description }}
                        </p>
                    </div>

                    <div class="mt-6 flex flex-col gap-3">
                        <div>
                            <span class="font-semibold">Urgence :</span>
                            <span 
                                class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                                @if($demande->urgence == 'haute') bg-red-100 text-red-700
                                @elseif($demande->urgence == 'moyenne') bg-yellow-100 text-yellow-700
                                @else bg-green-100 text-green-700
                                @endif
                                capitalize">
                                {{ $demande->urgence }}
                            </span>
                        </div>

                        <div>
                            <span class="font-semibold">Statut :</span>
                            <span class="capitalize text-gray-700">{{ str_replace('_', ' ', $demande->statut) }}</span>
                        </div>

                        <form method="POST" action="{{ route('admin.maintenances.update', $demande) }}" class="flex gap-2 items-center">
                            @csrf
                            @method('PATCH')
                            <select name="statut" class="border rounded px-2 py-1 text-sm flex-grow">
                                <option value="nouveau" @selected($demande->statut == 'nouveau')>Nouveau</option>
                                <option value="en_cours" @selected($demande->statut == 'en_cours')>En cours</option>
                                <option value="resolu" @selected($demande->statut == 'resolu')>Résolu</option>
                            </select>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm font-semibold transition">
                                Mettre à jour
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
