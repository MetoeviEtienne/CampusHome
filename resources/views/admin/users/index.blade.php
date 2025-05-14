@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Gestion des utilisateurs</h1>

    {{-- Étudiants --}}
    <div class="bg-white shadow rounded-xl p-4 mb-8">
        <h2 class="text-lg font-semibold text-green-700 mb-4 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0v6m0 0H5a2 2 0 01-2-2V10m9 10h7a2 2 0 002-2v-6" />
            </svg>
            Étudiants
        </h2>

        <div class="overflow-x-auto">
            <table class="w-full table-auto text-sm text-left border">
                <thead class="bg-green-100 text-green-800">
                    <tr>
                        <th class="px-4 py-2">Nom</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Ville</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users->where('role', 'student') as $user)
                        <tr class="border-b hover:bg-green-50">
                            <td class="px-4 py-2">{{ $user->name }}</td>
                            <td class="px-4 py-2">{{ $user->email }}</td>
                            <td class="px-4 py-2">{{ $user->ville }}</td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-500 hover:underline">Modifier</a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500 hover:underline" onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-2 text-center text-gray-500">Aucun étudiant trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Propriétaires --}}
    <div class="bg-white shadow rounded-xl p-4">
        <h2 class="text-lg font-semibold text-indigo-700 mb-4 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M9 16h6m2 4H7a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v12a2 2 0 01-2 2z" />
            </svg>
            Propriétaires
        </h2>

        <div class="overflow-x-auto">
            <table class="w-full table-auto text-sm text-left border">
                <thead class="bg-indigo-100 text-indigo-800">
                    <tr>
                        <th class="px-4 py-2">Nom</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Ville</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users->where('role', 'owner') as $user)
                        <tr class="border-b hover:bg-indigo-50">
                            <td class="px-4 py-2">{{ $user->name }}</td>
                            <td class="px-4 py-2">{{ $user->email }}</td>
                            <td class="px-4 py-2">{{ $user->ville }}</td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-500 hover:underline">Modifier</a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500 hover:underline" onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-2 text-center text-gray-500">Aucun propriétaire trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
