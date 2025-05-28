@extends('layouts.proprietaire')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">🔧 Demandes de maintenance</h2>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow-lg rounded-xl p-6">
        <table class="w-full text-sm text-gray-700">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs border-b">
                <tr>
                    <th class="py-3 px-4 text-left">🏠 Logement</th>
                    <th class="py-3 px-4 text-left">👤 Étudiant</th>
                    <th class="py-3 px-4 text-left">📝 Description</th>
                    <th class="py-3 px-4 text-left">⚠️ Urgence</th>
                    <th class="py-3 px-4 text-left">📌 Statut</th>
                    <th class="py-3 px-4 text-left">🛠️ Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($demandes as $demande)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="py-3 px-4">{{ $demande->logement->titre }}</td>
                        <td class="py-3 px-4">{{ $demande->etudiant->name }}</td>
                        <td class="py-3 px-4">{{ $demande->description }}</td>
                        <td class="py-3 px-4 capitalize">
                            <span class="font-semibold 
                                @if($demande->urgence == 'haute') text-red-600 
                                @elseif($demande->urgence == 'moyenne') text-yellow-500 
                                @else text-green-600 @endif">
                                {{ $demande->urgence }}
                            </span>
                        </td>
                        <td class="py-3 px-4 capitalize">
                            <span class="inline-block px-2 py-1 text-xs font-medium rounded 
                                @if($demande->statut == 'resolu') bg-green-100 text-green-700 
                                @elseif($demande->statut == 'en_cours') bg-yellow-100 text-yellow-700 
                                @else bg-blue-100 text-blue-700 @endif">
                                {{ str_replace('_', ' ', $demande->statut) }}
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <form method="POST" action="{{ route('proprietaire.maintenances.update', $demande) }}" class="flex items-center gap-2">
                                @csrf
                                @method('PATCH')
                                <select name="statut" class="border-gray-300 rounded px-2 py-1 text-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="nouveau" @selected($demande->statut == 'nouveau')>Nouveau</option>
                                    <option value="en_cours" @selected($demande->statut == 'en_cours')>En cours</option>
                                    <option value="resolu" @selected($demande->statut == 'resolu')>Résolu</option>
                                </select>
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded text-xs transition">Mettre à jour</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-6 text-center text-gray-500 italic">Aucune demande de maintenance trouvée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
