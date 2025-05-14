@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h2 class="text-2xl font-semibold mb-6">Tous les avis des étudiants</h2>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow-md rounded-lg p-4">
        <table class="w-full text-sm text-left text-gray-700">
            <thead class="text-xs uppercase text-gray-500 border-b">
                <tr>
                    <th class="py-3">Logement</th>
                    <th class="py-3">Propriétaire</th>
                    <th class="py-3">Auteur</th>
                    <th class="py-3">Note</th>
                    <th class="py-3">Commentaire</th>
                    <th class="py-3">Statut</th>
                    <th class="py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($avis as $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2">{{ $item->logement->titre ?? 'N/A' }}</td>
                        <td class="py-2">{{ $item->logement->proprietaire->name ?? 'N/A' }}</td>
                        <td class="py-2">{{ $item->auteur->name }}</td>
                        <td class="py-2">{{ $item->note }}/5</td>
                        <td class="py-2">{{ $item->commentaire }}</td>
                        <td class="py-2">
                            @if($item->verifie)
                                <span class="text-green-600 font-semibold">Vérifié</span>
                            @else
                                <span class="text-red-600 font-semibold">Non vérifié</span>
                            @endif
                        </td>
                        <td class="py-2">
                            @if(!$item->verifie)
                                <form method="POST" action="{{ route('admin.avis.verifier', $item) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="bg-blue-500 text-white px-3 py-1 text-xs rounded hover:bg-blue-600">Vérifier</button>
                                </form>
                            @else
                                <span class="text-gray-500 text-xs">Aucune action</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-4 text-center text-gray-500">Aucun avis trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
