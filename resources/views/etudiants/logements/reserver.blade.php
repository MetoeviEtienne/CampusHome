@extends('layouts.etudiant')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow rounded">
    <h1 class="text-2xl font-bold mb-4">{{ $logement->titre }}</h1>

    <p><strong>Ville :</strong> {{ $logement->ville }}</p>
    <p><strong>Loyer :</strong> {{ $logement->loyer }} FCFA</p>
    <p><strong>Description :</strong> {{ $logement->description }}</p>

    <hr class="my-4">

    <!-- Formulaire de réservation -->
    <h2 class="text-xl font-semibold mb-2">Réserver ce logement</h2>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('etudiant.reservations.store', $logement) }}" class="mt-4 space-y-3">
        @csrf
        <div>
            <label for="date_debut" class="block text-sm font-medium text-gray-700">Date de début</label>
            <input type="date" name="date_debut" required class="mt-1 block w-full border rounded px-3 py-2">
        </div>
        <div>
            <label for="date_fin" class="block text-sm font-medium text-gray-700">Date de fin</label>
            <input type="date" name="date_fin" required class="mt-1 block w-full border rounded px-3 py-2">
        </div>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Réserver ce logement
        </button>
    </form>
</div>
@endsection
