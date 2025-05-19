@extends('layouts.admin')

@section('title', 'Tableau de bord administrateur')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow mt-10">
    <h1 class="text-3xl font-bold mb-6">Messages reçus</h1>

    @foreach ($contacts as $contact)
        <div class="mb-6 border p-4 rounded bg-gray-50">
            <h2 class="text-xl font-semibold mb-2">De : {{ $contact->nom }}</h2>
            <ul class="list-disc pl-5 text-gray-700">
                <li><strong>Email :</strong> {{ $contact->email }}</li>
                <li><strong>Objet :</strong> {{ $contact->sujet ?? 'Non précisé' }}</li>
                <li><strong>Message :</strong> {{ $contact->message }}</li>
            </ul>
        </div>
    @endforeach

    @if ($contacts->isEmpty())
        <p class="text-gray-500">Aucun message pour le moment.</p>
    @endif
</div>
@endsection
