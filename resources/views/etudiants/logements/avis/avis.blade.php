@extends('layouts.naveshow')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded-2xl shadow-lg mt-8">
    <h2 class="text-2xl font-bold text-blue-600 mb-6 text-center">Donner votre avis sur : <span class="text-gray-800">{{ $logement->titre }}</span></h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('etudiant.logements.avis.store', $logement->id) }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label for="commentaire" class="block text-gray-700 font-medium mb-2">Votre commentaire</label>
            <textarea name="commentaire" id="commentaire" rows="5" placeholder = "Ecrivez ici" required
                      class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm">{{ old('commentaire') }}</textarea>
            @error('commentaire')
                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="text-center">
            <button type="submit"
                class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition duration-300">
                ✉️ Envoyer l'avis
            </button>
        </div>
    </form> 
</div>
@endsection
