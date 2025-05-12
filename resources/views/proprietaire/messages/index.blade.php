@extends('layouts.proprietaire')

@section('title', 'Messagerie')

@section('content')
<div class="container mx-auto">
    <div class="mb-4 flex justify-between items-center">
        <h2 class="text-xl font-semibold text-gray-700">Messagerie</h2>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-4 rounded-lg shadow">
        <h3 class="font-semibold text-lg text-gray-800">Conversations</h3>
        <div class="space-y-4 mt-4">
            @foreach ($messages as $message)
                <div class="flex items-center justify-between p-4 border-b">
                    <div class="flex flex-col">
                        <span class="text-sm text-gray-600">De : {{ $message->expediteur->name }}</span>
                        <p class="text-gray-800 mt-1">{{ $message->contenu }}</p>
                    </div>
                    <span class="text-xs text-gray-500">{{ $message->created_at->diffForHumans() }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <div class="mt-8">
        <h3 class="text-lg font-semibold text-gray-700">Envoyer un message</h3>
        <form action="{{ route('proprietaire.messages.store') }}" method="POST" class="mt-4">
            @csrf
            <div class="mb-4">
                <label for="destinataire_id" class="block text-sm text-gray-600">Destinataire</label>
                <input type="text" name="destinataire_id" id="destinataire_id" class="w-full px-4 py-2 border rounded" placeholder="ID du destinataire" required>
            </div>

            <div class="mb-4">
                <label for="contenu" class="block text-sm text-gray-600">Contenu</label>
                <textarea name="contenu" id="contenu" rows="4" class="w-full px-4 py-2 border rounded" required></textarea>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Envoyer</button>
        </form>
    </div>
</div>
@endsection
