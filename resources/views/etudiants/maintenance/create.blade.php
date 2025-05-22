@extends('layouts.etudiant')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Demande de maintenance</h2>

    <form method="POST" action="{{ route('etudiants.maintenance.store', $logement) }}">
        @csrf
        <div class="mb-4">
            <label for="description" class="block text-gray-700">Description du problème</label>
            <textarea name="description" id="description" required class="w-full border rounded px-3 py-2 mt-1">{{ old('description') }}</textarea>
        </div>

        <div class="mb-4">
            <label for="urgence" class="block text-gray-700">Niveau d'urgence</label>
            <select name="urgence" id="urgence" required class="w-full border rounded px-3 py-2 mt-1">
                <option value="faible">Faible</option>
                <option value="moyenne">Moyenne</option>
                <option value="haute">Haute</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Envoyer la demande
        </button>
    </form>
</div>
@endsection
