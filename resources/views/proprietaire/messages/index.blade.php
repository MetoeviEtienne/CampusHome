@extends('layouts.proprietaire')

@section('title', 'Messagerie')

@section('content')
<div class="max-w-3xl mx-auto px-4">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">📩 Messagerie</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Boîte de messages -->
    <div class="bg-white p-5 rounded-lg shadow mb-8 max-h-[400px] overflow-y-auto space-y-4">
        @forelse ($messages as $message)
            <div class="flex @if($message->expediteur_id == auth()->id()) justify-end @else justify-start @endif">
                <div class="max-w-[80%] p-4 rounded-lg shadow 
                    @if($message->expediteur_id == auth()->id()) bg-blue-100 text-right @else bg-gray-100 text-left @endif">
                    <p class="text-sm font-semibold text-gray-700">
                        De : {{ $message->expediteur->name }}
                    </p>
                    <p class="text-sm text-gray-500 mb-1">
                        {{ $message->created_at->diffForHumans() }}
                    </p>
                    <p class="text-gray-800">{{ $message->contenu }}</p>
                </div>
            </div>
        @empty
            <p class="text-gray-500 text-center italic">Aucun message pour l'instant.</p>
        @endforelse
    </div>

    <!-- Formulaire d'envoi -->
    <form action="{{ route('messages.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow space-y-5">
        @csrf

        <div>
            <label for="destinataire_id" class="block text-sm font-medium text-gray-700 mb-1">Destinataire</label>
            <select name="destinataire_id" id="destinataire_id" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="">Choisir un destinataire</option>
                @foreach ($destinataires as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            @error('destinataire_id')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="contenu" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
            <textarea name="contenu" id="contenu" rows="4" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none" required></textarea>
            @error('contenu')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="text-right">
            <button type="submit" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg transition">
                Envoyer
            </button>
        </div>
    </form>
</div>
@endsection
