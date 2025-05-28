@extends('layouts.proprietaire')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">🗣️ Avis reçus</h1>

    @if($avis->isEmpty())
        <div class="bg-blue-100 border border-blue-300 text-blue-700 px-4 py-3 rounded-lg shadow-sm">
            Aucun avis pour le moment.
        </div>
    @else
        <div class="overflow-x-auto bg-white shadow-lg rounded-xl">
            <table class="min-w-full text-sm text-left text-gray-700">
                <thead class="bg-blue-600 text-white text-xs uppercase tracking-wider">
                    <tr>
                        <th class="px-4 py-3">👤 Auteur</th>
                        <th class="px-4 py-3">🏠 Logement</th>
                        <th class="px-4 py-3">💬 Commentaire</th>
                        <th class="px-4 py-3">📅 Date</th>
                        <th class="px-4 py-3">⏰ Heure</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($avis as $index => $avisItem)
                        <tr class="{{ $index % 2 == 0 ? 'bg-gray-50' : 'bg-white' }} hover:bg-blue-50 transition">
                            <td class="px-4 py-3 font-medium">{{ $avisItem->auteur->name }}</td>
                            <td class="px-4 py-3">{{ $avisItem->logement->titre ?? '🛑 Logement supprimé' }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $avisItem->commentaire }}</td>
                            <td class="px-4 py-3">{{ $avisItem->created_at->format('d/m/Y') }}</td>
                            <td class="px-4 py-3">{{ $avisItem->created_at->format('H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
