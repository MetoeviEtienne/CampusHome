@extends('layouts.proprietaire')
{{-- Voir les avis côté propriétaire --}}
@section('content')
<div class="container mx-auto mt-4 px-4">
    <h1 class="mb-6 text-2xl font-semibold">Les avis du propriétaire</h1>

    @if($avis->isEmpty())
        <div class="bg-blue-100 text-blue-700 p-3 rounded">Aucun avis pour le moment.</div>
    @else
        <table class="min-w-full border border-gray-300">
            <thead>
                <tr class="bg-blue-600 text-white">
                    <th class="border border-gray-300 px-4 py-2 text-left">Auteur</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Logement</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Commentaire</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Date</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Heure</th>
                </tr>
            </thead>
            <tbody>
                @foreach($avis as $index => $avisItem)
                <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-100' }}">
                    <td class="border border-gray-300 px-4 py-2">{{ $avisItem->auteur->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $avisItem->logement->titre ?? 'Logement supprimé' }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $avisItem->commentaire }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $avisItem->created_at->format('d/m/Y') }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $avisItem->created_at->format('H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
