@extends('layouts.etudiant')

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
                                @elseif($reservation->statut === 'rejetee') text-red-600 
                                @elseif($reservation->statut === 'annulee') text-gray-500 
                                @else text-yellow-600 @endif">
                                {{ ucfirst($reservation->statut) }}
                            </span>
                        </p>
                        @if ($reservation->statut === 'approuvée')
                        {{-- Affiche le lien contrat uniquement si approuvée et contrat existant --}}
                        {{-- @if ($reservation->statut === 'approuvée' && $reservation->contrat) --}}
                        {{-- <a href="{{ route('etudiant.reservations.contrat', $reservation) }}" target="_blank" --}}
                            <a href="#" target="_blank"
                               class="inline-block mt-2 text-sm text-blue-600 hover:underline">
                                Voir le contrat PDF
                            </a>
                        @endif
                    </div>

                    {{-- Actions --}}
                    <div class="flex space-x-3">
                        @if ($reservation->statut === 'approuvée')
                        {{-- <a href="{{ route('etudiant.reservations.payerAvance', $reservation) }}"  --}}
                            <a href="#" 
                               class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">
                                Payer avance
                            </a>
                        @endif

                        @if ($reservation->statut !== 'approuvee')
                            <form action="{{ route('etudiant.reservations.destroy', $reservation) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 text-sm">
                                    Supprimer
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
