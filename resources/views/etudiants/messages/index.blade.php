@extends('layouts.naveshow')

@section('title')
    @isset($proprietaire)
        Discussion avec {{ $proprietaire->name }}
    @else
        Messagerie
    @endisset
@endsection

@section('content')
<div class="container mx-auto">
    <h2 class="text-xl font-semibold mb-4">
        @isset($proprietaire)
            Discussion avec {{ $proprietaire->name }}
        @else
            Vos discussions
        @endisset
    </h2>

    <div class="bg-white p-4 rounded shadow mb-8 max-h-[400px] overflow-y-auto">
        @forelse ($messages as $message)
            <div class="mb-3 p-3 border rounded @if($message->expediteur_id == auth()->id()) bg-blue-100 @else bg-gray-200 @endif">
                <strong>{{ $message->expediteur->name }}</strong><br>
                <small class="text-gray-500">{{ $message->created_at->diffForHumans() }}</small>
                <p class="mt-1">{{ $message->contenu }}</p>
            </div>
        @empty
            <p>Aucun message encore.</p>
        @endforelse
    </div>

    @isset($proprietaire)
        <form action="{{ route('messages.store') }}" method="POST" class="bg-white p-4 rounded shadow">
            @csrf
            <input type="hidden" name="destinataire_id" value="{{ $proprietaire->id }}">
            <div class="mb-4">
                <label for="contenu" class="block mb-1">Message</label>
                <textarea name="contenu" id="contenu" rows="4" class="w-full border rounded p-2" required></textarea>
                @error('contenu') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Envoyer</button>
        </form>
    @else
        <p class="text-gray-600">Sélectionnez un propriétaire pour démarrer une conversation.</p>
    @endisset
</div>
@endsection
