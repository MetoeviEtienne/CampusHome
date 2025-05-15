@extends('layouts.proprietaire')

@section('title', 'Messagerie')

@section('content')
<div class="container mx-auto">
    <h2 class="text-xl font-semibold mb-4">Messagerie</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">{{ session('success') }}</div>
    @endif

    <div class="bg-white p-4 rounded shadow mb-8 max-h-[400px] overflow-y-auto">
        @forelse ($messages as $message)
            <div class="mb-3 p-3 border rounded @if($message->expediteur_id == auth()->id()) bg-blue-50 @else bg-gray-100 @endif">
                <strong>De : {{ $message->expediteur->name }}</strong> <br>
                <small class="text-gray-500">{{ $message->created_at->diffForHumans() }}</small>
                <p class="mt-1">{{ $message->contenu }}</p>
            </div>
        @empty
            <p>Aucun message.</p>
        @endforelse
    </div>

    <form action="{{ route('messages.store') }}" method="POST" class="bg-white p-4 rounded shadow">
        @csrf
        <div class="mb-4">
            <label for="destinataire_id" class="block mb-1">Destinataire</label>
            <select name="destinataire_id" id="destinataire_id" class="w-full border rounded p-2" required>
                <option value="">-- Choisir un destinataire --</option>
                @foreach ($destinataires as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            @error('destinataire_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="contenu" class="block mb-1">Message</label>
            <textarea name="contenu" id="contenu" rows="4" class="w-full border rounded p-2" required></textarea>
            @error('contenu') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Envoyer</button>
    </form>
</div>
@endsection
