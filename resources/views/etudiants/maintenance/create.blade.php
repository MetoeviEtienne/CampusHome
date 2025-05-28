@extends('layouts.etudiant')

@section('content')
<div class="max-w-xl mx-auto mt-12 px-6 py-8 bg-white rounded-xl shadow-lg">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">📩 Demande de maintenance</h2>

    <form method="POST" action="{{ route('etudiants.maintenance.store', $logement) }}" class="space-y-6">
        @csrf

        {{-- Description du problème --}}
        <div>
            <label for="description" class="block text-gray-700 font-medium mb-2">Description du problème</label>
            <textarea
                name="description"
                id="description"
                rows="5"
                required
                placeholder = "Décrire votre problème ici"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >{{ old('description') }}</textarea>
        </div>

        {{-- Niveau d'urgence --}}
        <div>
            <label for="urgence" class="block text-gray-700 font-medium mb-2">Niveau d'urgence</label>
            <select
                name="urgence"
                id="urgence"
                required
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                <option value="" disabled selected>-- Sélectionner un niveau --</option>
                <option value="faible" {{ old('urgence') == 'faible' ? 'selected' : '' }}>Faible</option>
                <option value="moyenne" {{ old('urgence') == 'moyenne' ? 'selected' : '' }}>Moyenne</option>
                <option value="haute" {{ old('urgence') == 'haute' ? 'selected' : '' }}>Haute</option>
            </select>
        </div>

        {{-- Bouton de soumission --}}
        <div class="text-right">
            <button
                type="submit"
                class="inline-flex items-center bg-blue-600 text-white font-semibold px-6 py-3 rounded-lg hover:bg-blue-700 transition"
            >
                🚀 Envoyer la demande
            </button>
        </div>
    </form>
</div>
@endsection
