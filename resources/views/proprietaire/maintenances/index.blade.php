@extends('layouts.proprietaire')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h2 class="text-2xl font-semibold mb-6">Demandes de maintenance</h2>

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
                    <th class="py-3">Étudiant</th>
                    <th class="py-3">Description</th>
                    <th class="py-3">Urgence</th>
                    <th class="py-3">Statut</th>
                    <th class="py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($demandes as $demande)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2">{{ $demande->logement->titre }}</td>
                        <td class="py-2">{{ $demande->etudiant->name }}</td>
                        <td class="py-2">{{ $demande->description }}</td>
                        <td class="py-2 capitalize">
                            <span class="@if($demande->urgence == 'haute') text-red-600 font-bold 
                                          @elseif($demande->urgence == 'moyenne') text-yellow-600 
                                          @else text-green-600 @endif">
                                {{ $demande->urgence }}
                            </span>
                        </td>
                        <td class="py-2 capitalize">{{ str_replace('_', ' ', $demande->statut) }}</td>
                        <td class="py-2">
                            <form method="POST" action="{{ route('proprietaire.maintenances.update', $demande) }}" class="flex gap-2 items-center">
                                @csrf
                                @method('PATCH')
                                <select name="statut" class="border rounded px-2 py-1 text-sm">
                                    <option value="nouveau" @selected($demande->statut == 'nouveau')>Nouveau</option>
                                    <option value="en_cours" @selected($demande->statut == 'en_cours')>En cours</option>
                                    <option value="resolu" @selected($demande->statut == 'resolu')>Résolu</option>
                                </select>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs">Mettre à jour</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-4 text-center text-gray-500">Aucune demande de maintenance trouvée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
