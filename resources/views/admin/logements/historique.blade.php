@extends('layouts.admin')

@section('title', 'Historique des logements validés et rejetés')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-6">Historique des logements validés ou rejetés</h2>

    @forelse($proprietaires as $proprietaire)
        <div class="mb-8">
            <h3 class="text-xl font-semibold text-blue-700 mb-2">Propriétaire : {{ $proprietaire->name }}</h3>

            @foreach($proprietaire->logements as $logement)
                <div class="bg-white rounded-2xl shadow p-4 mb-4">
                    <h4 class="text-lg font-semibold">{{ $logement->titre }}</h4>

                    <!-- Photos -->
                    <div class="mb-3 overflow-x-auto flex gap-2">
                        @foreach($logement->photos as $photo)
                            <img src="{{ asset('storage/' . $photo->chemin) }}" alt="Photo du logement" class="w-32 h-32 object-cover rounded">
                        @endforeach
                    </div>

                    <p><strong>Adresse:</strong> {{ $logement->adresse }}</p>
                    <p><strong>Type:</strong> {{ ucfirst($logement->type) }}</p>
                    <p><strong>Loyer:</strong> {{ number_format($logement->loyer, 0, ',', ' ') }} FCFA</p>
                    <p>
                        <strong>Statut:</strong>
                        @if($logement->valide)
                            <span class="text-green-600 font-bold">Validé</span>
                        @elseif($logement->etat === 'rejeté')
                            <span class="text-red-600 font-bold">Rejeté</span>
                        @else
                            <span class="text-gray-600">Inconnu</span>
                        @endif
                    </p>
                </div>
            @endforeach
        </div>
    @empty
        <p class="text-gray-500">Aucun logement validé ou rejeté pour le moment.</p>
    @endforelse
</div>
@endsection
