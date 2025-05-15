@extends(Auth::user()->role === 'owner' ? 'layouts.proprietaire' : 'layouts.etudiant')

@section('title', 'Discussion')

@section('content')
<div class="max-w-4xl mx-auto p-4">
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b flex justify-between items-center">
            <h2 class="text-xl font-semibold">Discussion avec {{ $utilisateur->name }}</h2>
        </div>

        <div class="p-6 space-y-4 h-[60vh] overflow-y-scroll bg-gray-50">
            @foreach($messages as $message)
                <div class="flex {{ $message->expediteur_id === Auth::id() ? 'justify-end' : 'justify-start' }}">
                    <div class="px-4 py-2 rounded-lg {{ $message->expediteur_id === Auth::id() ? 'bg-blue-500 text-white' : 'bg-gray-300 text-gray-800' }}">
                        {{ $message->contenu }}
                        <div class="text-xs mt-1 opacity-60">{{ $message->created_at->format('H:i') }}</div>
                    </div>
                </div>
            @endforeach
        </div>

        <form action="{{ route('messages.store') }}" method="POST" class="p-4 border-t bg-white flex gap-2">
            @csrf
            <input type="hidden" name="destinataire_id" value="{{ $utilisateur->id }}">
            <input type="text" name="contenu" class="flex-1 border rounded px-4 py-2" placeholder="Tapez votre message..." required>
            <button type="submit" class="bg-blue-600 text-white px-4 rounded">Envoyer</button>
        </form>
    </div>
</div>
@endsection
