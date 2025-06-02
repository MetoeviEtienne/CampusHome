@extends('layouts.admin')

@section('content')
<div class="container mx-auto py-6 px-4">
    <h2 class="text-3xl font-extrabold text-center text-gray-800 mb-8">Liste des paiements</h2>

    @if(session('success'))
        <div class="max-w-xl mx-auto mb-6 p-4 bg-green-100 border border-green-300 rounded-lg text-green-800 text-center font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($paiements as $paiement)
        <div class="bg-white shadow-md rounded-lg border border-gray-200 p-6 flex flex-col justify-between hover:shadow-lg transition-shadow">
            <div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2 truncate" title="{{ $paiement->reservation->logement->titre ?? '-' }}">
                    {{ $paiement->reservation->logement->titre ?? '-' }}
                </h3>
                <p class="text-gray-700 mb-1"><span class="font-semibold">Étudiant :</span> {{ $paiement->reservation->etudiant->name ?? '-' }}</p>
                <p class="text-gray-700 mb-1"><span class="font-semibold">Propriétaire :</span> {{ $paiement->reservation->logement->proprietaire->name ?? '-' }}</p>
                <p class="text-gray-600 mb-2 truncate" title="{{ $paiement->reservation->logement->adresse ?? '-' }}">
                    <span class="font-semibold">Adresse :</span> {{ $paiement->reservation->logement->adresse ?? '-' }}
                </p>
                <p class="text-blue-600 font-bold text-lg mb-1">{{ number_format($paiement->montant, 0, ',', ' ') }} FCFA</p>
                <p class="capitalize text-gray-700 mb-1"><span class="font-semibold">Type :</span> {{ $paiement->type }}</p>
                <p class="mb-2">
                    <span class="px-3 py-1 rounded-full text-sm font-semibold
                        {{ $paiement->statut === 'payé' ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                        {{ $paiement->statut }}
                    </span>
                </p>
                <p class="text-sm text-gray-500 mb-4">Date : {{ $paiement->created_at->format('d/m/Y') }}</p>
            </div>
            <div class="flex items-center justify-between">
                @if ($paiement->quittance)
                <a href="{{ asset('storage/' . $paiement->quittance) }}" target="_blank" class="text-indigo-600 hover:text-indigo-800 font-semibold flex items-center space-x-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Télécharger reçu</span>
                </a>
                @else
                <span class="text-gray-400 italic">Pas de reçu</span>
                @endif

                <form action="{{ route('admin.paiements.destroy', $paiement->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce paiement ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-800 flex items-center space-x-1" title="Supprimer paiement">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        <span class="sr-only">Supprimer</span>
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-8 flex justify-center">
        {{ $paiements->links() }}
    </div>
</div>
@endsection
