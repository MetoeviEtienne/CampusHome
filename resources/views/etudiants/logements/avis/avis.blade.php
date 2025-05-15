@extends('layouts.etudiant')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-xl font-bold mb-4">Donner un avis sur : {{ $logement->titre }}</h2>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('etudiant.logements.avis.store', $logement->id) }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="commentaire" class="block mb-1 font-semibold">Commentaire</label>
            <textarea name="commentaire" id="commentaire" rows="4" required
                      class="border rounded p-2 w-full">{{ old('commentaire') }}</textarea>
            @error('commentaire')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Envoyer l'avis
        </button>
    </form>
</div>
@endsection
