@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-7xl mx-auto">
    <h1 class="text-3xl font-bold mb-8 text-gray-900">Gestion des utilisateurs</h1>

    {{-- Étudiants --}}
    <section class="mb-12">
        <h2 class="text-xl font-semibold text-green-700 mb-6 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0v6m0 0H5a2 2 0 01-2-2V10m9 10h7a2 2 0 002-2v-6" />
            </svg>
            Étudiants ({{ $users->where('role', 'student')->count() }})
        </h2>

        @if($users->where('role', 'student')->isEmpty())
            <p class="text-center text-gray-500 italic">Aucun étudiant trouvé.</p>
        @else
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($users->where('role', 'student') as $user)
                    <div class="bg-white shadow-md rounded-lg p-5 flex flex-col justify-between hover:shadow-lg transition">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 truncate" title="{{ $user->name }}">{{ $user->name }}</h3>
                            <p class="text-sm text-gray-600 truncate" title="{{ $user->email }}">{{ $user->email }}</p>
                            <p class="text-sm text-gray-600 mt-1 capitalize">{{ $user->ville ?? 'Ville non renseignée' }}</p>
                        </div>
                        <div class="mt-4 flex justify-end gap-4 text-sm">
                            <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600 hover:text-blue-800 font-medium">Modifier</a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Supprimer cet utilisateur ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Supprimer</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>

    {{-- Propriétaires --}}
    <section>
        <h2 class="text-xl font-semibold text-indigo-700 mb-6 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M9 16h6m2 4H7a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v12a2 2 0 01-2 2z" />
            </svg>
            Propriétaires ({{ $users->where('role', 'owner')->count() }})
        </h2>

        @if($users->where('role', 'owner')->isEmpty())
            <p class="text-center text-gray-500 italic">Aucun propriétaire trouvé.</p>
        @else
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($users->where('role', 'owner') as $user)
                    <div class="bg-white shadow-md rounded-lg p-5 flex flex-col justify-between hover:shadow-lg transition">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 truncate" title="{{ $user->name }}">{{ $user->name }}</h3>
                            <p class="text-sm text-gray-600 truncate" title="{{ $user->email }}">{{ $user->email }}</p>
                            <p class="text-sm text-gray-600 mt-1 capitalize">{{ $user->ville ?? 'Ville non renseignée' }}</p>
                        </div>
                        <div class="mt-4 flex justify-end gap-4 text-sm">
                            <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600 hover:text-blue-800 font-medium">Modifier</a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Supprimer cet utilisateur ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Supprimer</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>
</div>
@endsection
