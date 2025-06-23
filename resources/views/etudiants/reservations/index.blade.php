@extends('layouts.naveshow')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-10">
    <h1 class="text-3xl font-bold text-center text-indigo-600 mb-8">Mes Réservations</h1>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif

    @if($reservations->isEmpty())
        <p class="text-center text-gray-500 text-lg">Aucune réservation trouvée pour le moment.</p>
    @else
        <div class="space-y-6">
            @foreach ($reservations as $reservation)
                <div class="bg-white shadow-lg rounded-xl p-6 border border-gray-200">
                    <div class="flex justify-between items-start gap-6">
                        <div class="flex-1 space-y-2">
                            <h2 class="text-xl font-semibold text-indigo-700">
                                {{ $reservation->logement->titre ?? 'Titre non disponible' }}
                            </h2>
                            <p><span class="font-semibold"><i class="fas fa-city mr-1 text-indigo-500"></i>Ville :</span> {{ $reservation->logement->adresse ?? 'Non renseignée' }}</p>
                            <p><span class="font-semibold"><i class="fas fa-map-marker-alt mr-1 text-indigo-500"></i>Quartier :</span> {{ $reservation->logement->quartier ?? 'Non renseignée' }}</p>
                            <p><span class="font-semibold"><i class="fas fa-home mr-1 text-indigo-500"></i>Type :</span> {{ $reservation->logement->type ?? 'Non renseigné' }}</p>
                            <p><span class="font-semibold"><i class="fas fa-calendar-alt mr-1 text-indigo-500"></i>Période :</span> du {{ \Carbon\Carbon::parse($reservation->date_debut)->format('d/m/Y') }} au {{ \Carbon\Carbon::parse($reservation->date_fin)->format('d/m/Y') }}</p>
                            <p>
                                <span class="font-semibold"><i class="fas fa-tag mr-1 text-indigo-500"></i>Statut :</span>
                                <span class="px-2 py-1 rounded text-sm font-medium
                                    @if($reservation->statut === 'approuvée') bg-green-100 text-green-700 
                                    @elseif($reservation->statut === 'rejetée') bg-red-100 text-red-700 
                                    @elseif($reservation->statut === 'annulée') bg-gray-100 text-gray-700 
                                    @else bg-yellow-100 text-yellow-700 @endif">
                                    {{ ucfirst($reservation->statut) }}
                                </span>
                            </p>

                            @if ($reservation->statut === 'approuvée' && $reservation->contrat)
                                <a href="{{ asset('storage/' . $reservation->contrat) }}" download class="text-sm text-blue-600 hover:underline block">
                                    <i class="fas fa-file-pdf mr-1"></i>Télécharger le contrat PDF
                                </a>
                            @endif

                            <a href="{{ route('etudiant.logements.show', $reservation->logement_id) }}"
                                class="text-sm text-indigo-600 hover:underline">
                                <i class="fas fa-eye mr-1"></i>Voir le logement
                            </a>
                        </div>

                        <div class="flex flex-col gap-2 items-end">
                            @if ($reservation->statut === 'approuvée')
                                <form action="{{ route('paiement.momo') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="phone" value="{{ auth()->user()->phone ?? '' }}">
                                    @php
                                        $aPayeAvance = $reservation->aPayeAvance();
                                        $amount = $aPayeAvance 
                                            ? $reservation->logement->loyer 
                                            : $reservation->logement->loyer * 3.5;
                                        $type = $aPayeAvance ? 'loyer' : 'avance';
                                    @endphp
                                    <input type="hidden" name="amount" value="{{ $amount }}">
                                    <input type="hidden" name="type" value="{{ $type }}">
                                    <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">

                                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 text-sm transition">
                                        <i class="fas fa-credit-card mr-1"></i>Payer {{ $type }}
                                    </button>
                                </form>
                            @endif

                            <form action="{{ route('etudiant.reservations.destroy', $reservation) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-1.5 rounded-md text-sm hover:bg-red-700 transition">
                                    <i class="fas fa-trash-alt mr-1"></i>Supprimer
                                </button>
                            </form>

                            @if ($reservation->paiement)
                                <a href="{{ route('paiement.recu', $reservation->paiement->id) }}" target="_blank"
                                   class="bg-gray-700 text-white px-4 py-1.5 rounded-md text-sm hover:bg-gray-800 transition">
                                    <i class="fas fa-receipt mr-1"></i>Reçu de paiement
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
