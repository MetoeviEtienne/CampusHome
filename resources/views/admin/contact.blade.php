@extends('layouts.admin')

@section('title', 'Tableau de bord administrateur')

@section('content')
<div class="max-w-5xl mx-auto p-6 mt-10">
    <h1 class="text-3xl font-bold mb-8 text-center text-gray-800">📩 Messages reçus</h1>

    @forelse ($contacts as $contact)
        <div class="bg-white rounded-2xl shadow-md p-6 mb-6 transition hover:shadow-lg border-l-4 border-blue-500 relative">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-xl font-semibold text-gray-800">De : {{ $contact->nom }}</h2>
                <span class="text-sm text-gray-500">{{ $contact->created_at->format('d/m/Y H:i') }}</span>
            </div>

            <div class="text-gray-700 space-y-2 mb-4">
                <p><span class="font-medium">📧 Email :</span> {{ $contact->email }}</p>
                <p><span class="font-medium">📝 Objet :</span> {{ $contact->sujet ?? 'Non précisé' }}</p>
                <p><span class="font-medium">💬 Message :</span><br>{{ $contact->message }}</p>
            </div>

            <!-- Bouton de suppression -->
            <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce message ?')" class="text-right">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded shadow">
                    🗑️ Supprimer
                </button>
            </form>
        </div>
    @empty
        <p class="text-gray-500 text-center">Aucun message pour le moment.</p>
    @endforelse
</div>
@endsection
