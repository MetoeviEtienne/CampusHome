@extends('layouts.naveshow')

@section('title')
    @isset($proprietaire)
        Discussion avec {{ $proprietaire->name }}
    @else
        Messagerie
    @endisset
@endsection

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h2 class="text-2xl font-bold text-blue-600 mb-6 text-center">
        @isset($proprietaire)
            💬 Discussion avec <span class="text-gray-800">{{ $proprietaire->name }}</span>
        @else
            📬 Vos discussions
        @endisset
    </h2>

    <div class="bg-white p-5 rounded-2xl shadow-md max-h-[400px] overflow-y-auto space-y-4 mb-8 border border-gray-100">
        @forelse ($messages as $message)
            <div class="flex flex-col @if($message->expediteur_id == auth()->id()) items-end @else items-start @endif">
                <div class="max-w-lg px-4 py-3 rounded-xl 
                    @if($message->expediteur_id == auth()->id()) bg-blue-100 text-right @else bg-gray-100 text-left @endif
                shadow-sm">
                    <div class="text-sm font-semibold text-gray-700">{{ $message->expediteur->name }}</div>
                    <div class="text-sm text-gray-600 mt-1">{{ $message->contenu }}</div>
                    <div class="text-xs text-gray-500 mt-1">{{ $message->created_at->diffForHumans() }}</div>
                </div>
            </div>
        @empty
            <p class="text-gray-500 text-center">Aucun message pour le moment.</p>
        @endforelse
    </div>

    @isset($proprietaire)
        <form action="{{ route('messages.store') }}" method="POST" class="bg-white p-6 rounded-2xl shadow-md border border-gray-100">
            @csrf
            <input type="hidden" name="destinataire_id" value="{{ $proprietaire->id }}">

            <div class="mb-4">
                <label for="contenu" class="block text-sm font-medium text-gray-700 mb-2">Votre message</label>
                <textarea name="contenu" id="contenu" rows="4" required
                          class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm resize-none"
                          placeholder="Écrivez votre message ici..."></textarea>
                @error('contenu') 
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p> 
                @enderror
            </div>

            <div class="text-right">
                <button type="submit"
                    class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-5 rounded-lg shadow-md transition duration-300">
                    📤 Envoyer
                </button>
            </div>
        </form>
    @else
        <p class="text-gray-600 text-center italic">Sélectionnez un propriétaire pour démarrer une conversation.</p>
    @endisset
</div>
@endsection
