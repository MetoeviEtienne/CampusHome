@extends('layouts.proprietaire')

@section('title', 'Réservations')

@section('content')
<h2 class="text-2xl font-semibold mb-6 text-gray-800">Demandes de réservation</h2>

@if ($reservations->isEmpty())
    <p class="text-gray-500 italic">Aucune demande pour l'instant.</p>
@else
    <div class="space-y-5">
        @foreach ($reservations as $reservation)
            <div class="bg-white p-5 rounded-lg shadow-md flex justify-between items-center hover:shadow-lg transition-shadow duration-300">
                <div class="space-y-1 max-w-xl">
                    <p class="text-lg font-medium text-gray-900">
                        <strong>{{ $reservation->etudiant->name }}</strong> a réservé <strong>{{ $reservation->logement->titre }}</strong>
                    </p>
                    <p class="text-sm text-gray-600">Pour le <time datetime="{{ $reservation->date_debut }}">{{ \Carbon\Carbon::parse($reservation->date_debut)->format('d/m/Y') }}</time></p>

                    {{-- Université --}}
                    <p class="text-sm text-gray-700">Université : <strong>{{ $reservation->universite }}</strong></p>

                    {{-- Inscription PDF --}}
                    <p class="text-sm text-gray-700">
                        Inscription PDF : 
                        @if ($reservation->inscription_pdf)
                            <a href="{{ asset('storage/' . $reservation->inscription_pdf) }}" target="_blank" 
                               class="text-indigo-600 underline hover:text-indigo-800 transition-colors">
                                Voir le document
                            </a>
                        @else
                            <span class="italic text-gray-400">Aucun document</span>
                        @endif
                    </p>

                    <p class="text-sm mt-1">
                        Statut : 
                        <span class="font-semibold 
                            {{ $reservation->statut === 'approuvee' ? 'text-green-700' : '' }}
                            {{ $reservation->statut === 'rejetee' ? 'text-red-700' : '' }}
                            {{ $reservation->statut === 'en_attente' ? 'text-yellow-600' : '' }}">
                            {{ ucfirst($reservation->statut) }}
                        </span>
                    </p>
                </div>

                <div class="flex gap-3 items-center whitespace-nowrap">
                    @if ($reservation->statut === 'en_attente')
                        <form method="POST" action="{{ route('proprietaire.reservations.approve', $reservation) }}">
                            @csrf
                            <button type="submit" 
                                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md font-semibold shadow-sm transition">
                                Approuver
                            </button>
                        </form>
                        <form method="POST" action="{{ route('proprietaire.reservations.reject', $reservation) }}">
                            @csrf
                            <button type="submit" 
                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md font-semibold shadow-sm transition">
                                Rejeter
                            </button>
                        </form>
                    @endif

                    <form method="POST" action="{{ route('proprietaire.reservations.destroy', $reservation) }}" 
                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="bg-gray-700 hover:bg-gray-900 text-white px-4 py-2 rounded-md font-semibold shadow-sm transition">
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $reservations->links() }}
    </div>
@endif
@endsection
