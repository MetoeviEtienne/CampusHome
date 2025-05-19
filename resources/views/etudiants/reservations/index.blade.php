@extends('layouts.naveshow')

@section('content')
<div class="max-w-5xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold mb-6 text-center text-blue-600">Mes Réservations</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if($reservations->isEmpty())
        <p class="text-gray-600 text-center">Vous n'avez encore réservé aucun logement.</p>
    @else
        <div class="space-y-4">
            @foreach ($reservations as $reservation)
                <div class="p-4 bg-gray-50 border rounded-md shadow-sm flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-semibold text-blue-700">
                            {{ $reservation->logement->titre ?? 'Titre non disponible' }}
                        </h2>
                        <p><strong>Ville :</strong> {{ $reservation->logement->adresse ?? 'Non renseignée' }}</p>
                        <p><strong>Type :</strong> {{ $reservation->logement->type ?? 'Non renseignée' }}</p>
                        <p>
                            <strong>Du :</strong> {{ \Carbon\Carbon::parse($reservation->date_debut)->format('d/m/Y') }}
                            <strong>au</strong> {{ \Carbon\Carbon::parse($reservation->date_fin)->format('d/m/Y') }}
                        </p>
                        <p>
                            <strong>Statut :</strong> 
                            <span class="font-semibold text-sm 
                                @if($reservation->statut === 'approuvée') text-green-600 
                                @elseif($reservation->statut === 'rejetée') text-red-600 
                                @elseif($reservation->statut === 'annulée') text-gray-500 
                                @else text-yellow-600 @endif">
                                {{ ucfirst($reservation->statut) }}
                            </span>
                        </p>

                        {{-- Lien vers le contrat si approuvée --}}
                        @if ($reservation->statut === 'approuvée' && $reservation->contrat)
                            <a href="{{ asset('storage/' . $reservation->contrat) }}" 
                               download 
                               class="inline-block mt-2 text-sm text-blue-600 hover:underline">
                                📄 Télécharger le contrat PDF
                            </a>
                        @endif
                    </div>
                     {{-- @if ($reservation->statut === 'approuvée')
                    <form action="{{ route('paiement.momo') }}" method="POST">
                        @csrf
                        <input type="hidden" name="phone" value="{{ auth()->user()->phone ?? '' }}">
                        <input type="hidden" name="amount" value="{{ $reservation->logement->loyer * 0.3 }}">
                        <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">
                            Payer avance
                        </button>
                    </form>
                    @endif --}}

                    {{-- Afficher le bouton de paiement uniquement si le statut est approuvé --}}
                    {{-- Actions --}}
                    <div class="flex flex-col space-y-2 items-end">
                        @if ($reservation->statut === 'approuvée')
                            <a href="#"
                               class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">
                                Payer avance
                            </a>
                        @endif

                        {{-- Supprimer disponible tout le temps --}}
                        <form action="{{ route('etudiant.reservations.destroy', $reservation) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 text-sm">
                                Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
