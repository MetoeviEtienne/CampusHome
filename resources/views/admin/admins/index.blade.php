@extends('layouts.admin')

@section('content')
<!-- Titre centré -->
<div class="mb-6">
    <h2 class="text-2xl font-bold text-center">Les Administrateurs du CampusHome</h2>
</div>

<!-- Barre de recherche + bouton Ajouter -->
<div class="mb-6 flex flex-col md:flex-row justify-between items-center gap-4">
    <!-- Formulaire de recherche -->
    <form method="GET" class="flex items-center gap-2">
        <input type="text" name="search" value="{{ $search }}" placeholder="Rechercher..."
            class="border rounded px-4 py-2 w-64" />
        <button class="bg-gray-600 text-white px-3 py-2 rounded hover:bg-gray-700">
            Rechercher
        </button>
    </form>

    <!-- Bouton Ajouter -->
    <a href="{{ route('admin.admins.create') }}"
    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 flex items-center gap-2">
    <span class="text-orange-500 text-lg font-bold">➕</span>
    <span>Ajouter</span>
    </a>
</div>

@if(session('success'))
    <div class="mb-4 text-green-600">{{ session('success') }}</div>
@endif

<table class="w-full table-auto bg-white rounded shadow">
    <thead>
        <tr class="bg-gray-100 text-left">
            <th class="p-3">Nom</th>
            <th class="p-3">Email</th>
            <th class="p-3">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($admins as $admin)
        <tr class="border-t">
            <td class="p-3">{{ $admin->name }}</td>
            <td class="p-3">{{ $admin->email }}</td>
            <td class="p-3">
                <a href="{{ route('admin.admins.edit', $admin) }}" class="text-blue-500">Modifier</a> |
                <form action="{{ route('admin.admins.destroy', $admin) }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button class="text-red-500" onclick="return confirm('Supprimer cet admin ?')">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $admins->withQueryString()->links() }}
</div>
@endsection
