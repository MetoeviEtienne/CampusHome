@extends('layouts.naveshow')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-10">
    <h1 class="text-3xl font-bold text-center text-indigo-600 mb-8">Mes Réservations</h1>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded mb-6 transition">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded mb-6 transition">
            {{ session('error') }}
        </div>
    @endif

    @if($reservations->isEmpty())
        <p class="text-center text-gray-500 text-lg">Aucune réservation trouvée pour le moment.</p>
    @else
        <div class="space-y-8">
            @foreach ($reservations as $reservation)
                <div class="bg-white shadow-xl rounded-xl border border-gray-200 flex flex-col md:flex-row overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                    {{-- Image logement --}}
                    <div class="w-full md:w-56 h-48 md:h-auto flex-shrink-0 overflow-hidden rounded-t-xl md:rounded-l-xl md:rounded-tr-none">
                        @php
                            $photo = $reservation->logement->photos->first();
                        @endphp
                        @if($photo)
                            <img src="{{ asset('storage/' . $photo->chemin) }}" alt="Photo logement" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                        @else
                            <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400 text-sm">
                                Pas de photo
                            </div>
                        @endif
                    </div>

                    {{-- Infos + actions --}}
                    <div class="flex-1 p-6 flex flex-col justify-between">
                        <div>
                            <h2 class="text-2xl font-semibold text-indigo-700 mb-2">
                                {{ $reservation->logement->titre ?? 'Titre non disponible' }}
                            </h2>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-gray-700 mb-4">
                                <p><span class="font-semibold inline-flex items-center gap-1"><i class="fas fa-city text-indigo-500"></i> Ville :</span> {{ $reservation->logement->adresse ?? 'Non renseignée' }}</p>
                                <p><span class="font-semibold inline-flex items-center gap-1"><i class="fas fa-map-marker-alt text-indigo-500"></i> Quartier :</span> {{ $reservation->logement->quartier ?? 'Non renseignée' }}</p>
                                <p><span class="font-semibold inline-flex items-center gap-1"><i class="fas fa-home text-indigo-500"></i> Type :</span> {{ $reservation->logement->type ?? 'Non renseigné' }}</p>
                                <p><span class="font-semibold inline-flex items-center gap-1"><i class="fas fa-calendar-alt text-indigo-500"></i> Période :</span> du {{ \Carbon\Carbon::parse($reservation->date_debut)->format('d/m/Y') }} au {{ \Carbon\Carbon::parse($reservation->date_fin)->format('d/m/Y') }}</p>
                            </div>

                            <p class="mb-3">
                                <span class="font-semibold inline-flex items-center gap-1"><i class="fas fa-tag text-indigo-500"></i> Statut :</span>
                                <span class="px-3 py-1 rounded-full text-sm font-medium
                                    @if($reservation->statut === 'approuvée') bg-green-100 text-green-700 
                                    @elseif($reservation->statut === 'rejetée') bg-red-100 text-red-700 
                                    @elseif($reservation->statut === 'annulée') bg-gray-100 text-gray-700 
                                    @else bg-yellow-100 text-yellow-700 @endif">
                                    {{ ucfirst($reservation->statut) }}
                                </span>
                            </p>

                            @if ($reservation->statut === 'approuvée' && $reservation->contrat)
                                <a href="{{ asset('storage/' . $reservation->contrat) }}" download class="inline-flex items-center gap-2 text-blue-600 hover:underline font-medium mb-3 transition">
                                    <i class="fas fa-file-pdf"></i> Télécharger le contrat PDF
                                </a>
                            @endif

                            <a href="{{ route('etudiant.logements.show', $reservation->logement_id) }}"
                               class="inline-block text-indigo-600 hover:underline font-medium transition mb-3">
                                <i class="fas fa-eye mr-1"></i> Voir le logement
                            </a>

                            {{-- Statut visite + lien appel au proprio --}}
                            @if ($reservation->visite_confirmee)
                                <a href="tel:{{ $reservation->logement->proprietaire->phone ?? '' }}" 
                                   class="inline-block text-green-700 font-semibold hover:underline mt-2 transition">
                                    ✔ Visite confirmée - Appeler le propriétaire
                                </a>
                            @elseif ($reservation->visite_rejetee)
                                <a href="tel:{{ $reservation->logement->proprietaire->phone ?? '' }}" 
                                   class="inline-block text-red-700 font-semibold hover:underline mt-2 transition">
                                    ✘ Visite rejetée - Appeler le propriétaire
                                </a>
                            @endif
                        </div>

                        {{-- Boutons --}}
                        <div class="mt-6 flex flex-wrap gap-3 justify-end">
                            @if ($reservation->statut === 'approuvée')
                                <form action="{{ route('paiement.momo') }}" method="POST" class="inline-block flex-shrink-0">
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

                                    <button type="submit" 
                                            class="flex items-center gap-2 bg-green-600 text-white px-5 py-2 rounded-full hover:bg-green-700 transition duration-300 text-sm shadow-md">
                                        <i class="fas fa-credit-card"></i> Payer {{ $type }}
                                    </button>
                                </form>
                            @endif

                            <form action="{{ route('etudiant.reservations.destroy', $reservation) }}" method="POST" 
                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?');" 
                                  class="inline-block flex-shrink-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="flex items-center gap-2 bg-red-600 text-white px-5 py-2 rounded-full hover:bg-red-700 transition duration-300 text-sm shadow-md">
                                    <i class="fas fa-trash-alt"></i> Supprimer
                                </button>
                            </form>

                            @if ($reservation->paiement)
                                <a href="{{ route('paiement.recu', $reservation->paiement->id) }}" target="_blank"
                                   class="inline-flex items-center gap-2 bg-gray-800 text-white px-5 py-2 rounded-full hover:bg-gray-900 transition duration-300 text-sm shadow-md">
                                    <i class="fas fa-receipt"></i> Reçu de paiement
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
