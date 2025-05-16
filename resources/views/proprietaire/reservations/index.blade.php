@extends('layouts.proprietaire')

@section('title', 'Réservations')

@section('content')
<h2 class="text-xl font-bold mb-4">Demandes de réservation</h2>

@if ($reservations->isEmpty())
    <p class="text-gray-600">Aucune demande pour l'instant.</p>
@else
    <div class="space-y-4">
        @foreach ($reservations as $reservation)
            <div class="bg-white p-4 rounded shadow flex justify-between items-center">
                <div>
                    <p><strong>{{ $reservation->etudiant->name }}</strong> a réservé <strong>{{ $reservation->logement->titre }}</strong></p>
                    <p class="text-sm text-gray-600">Pour le {{ \Carbon\Carbon::parse($reservation->date_debut)->format('d/m/Y') }}</p>
                    <p class="text-sm">
                        Statut :
                        <span class="font-semibold text-{{ $reservation->statut === 'approuvee' ? 'green' : ($reservation->statut === 'rejetee' ? 'red' : 'yellow') }}-600">
                            {{ ucfirst($reservation->statut) }}
                        </span>
                    </p>
                </div>

                <div class="flex gap-2 items-center">
                    @if ($reservation->statut === 'en_attente')
                        <form method="POST" action="{{ route('proprietaire.reservations.approve', $reservation) }}">
                            @csrf
                            <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">Approuver</button>
                        </form>
                        <form method="POST" action="{{ route('proprietaire.reservations.reject', $reservation) }}">
                            @csrf
                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Rejeter</button>
                        </form>
                    @endif

                    <!-- Bouton de suppression visible pour toutes les réservations -->
                    <form method="POST" action="{{ route('proprietaire.reservations.destroy', $reservation) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-gray-600">
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $reservations->links() }}
    </div>
@endif
@endsection
