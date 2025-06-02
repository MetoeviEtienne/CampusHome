@extends('layouts.admin')

@section('content')
<div class="p-4 max-w-7xl mx-auto">

    <h2 class="text-2xl sm:text-3xl font-extrabold text-center text-gray-800 mb-6 tracking-wide">
    Les Administrateurs du CampusHome
</h2>

<div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-6 px-4 sm:px-0">
    <form method="GET" class="flex items-center gap-2 w-full sm:max-w-md">
        <input 
            type="text" 
            name="search" 
            value="{{ $search }}" 
            placeholder="Rechercher..."
            class="flex-grow border border-gray-300 rounded-lg px-3 py-2 text-gray-700 placeholder-gray-400
                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
        />
        <button 
            type="submit"
            class="bg-gray-700 text-white rounded-lg px-4 py-2 font-semibold hover:bg-gray-800 transition whitespace-nowrap"
        >
            Rechercher
        </button>
    </form>

    <a href="{{ route('admin.admins.create') }}"
        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold 
               rounded-lg px-4 py-2 shadow-md transition focus:outline-none focus:ring-2 focus:ring-blue-500 whitespace-nowrap"
    >
        <span class="text-xl">➕</span>
        <span>Ajouter</span>
    </a>
</div>


    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg shadow-sm text-center font-medium">
            {{ session('success') }}
        </div>
    @endif

    <!-- TABLEAU pour desktop -->
    <div class="overflow-x-auto rounded-lg shadow-lg hidden md:block">
        <table class="min-w-full bg-white divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Nom
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Email
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($admins as $admin)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 whitespace-nowrap text-gray-800 font-medium">
                        {{ $admin->name }}
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap text-gray-600 break-words max-w-xs">
                        {{ $admin->email }}
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap space-x-3">
                        <a href="{{ route('admin.admins.edit', $admin) }}" 
                           class="text-blue-600 hover:text-blue-800 font-semibold transition">
                            Modifier
                        </a>
                        |
                        <form action="{{ route('admin.admins.destroy', $admin) }}" method="POST" class="inline">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" 
                                    onclick="return confirm('Supprimer cet admin ?')" 
                                    class="text-red-600 hover:text-red-800 font-semibold transition">
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- LISTE pour mobile (cartes) -->
    <div class="space-y-4 md:hidden">
        @foreach ($admins as $admin)
        <div class="bg-white shadow rounded-lg p-4">
            <p class="font-semibold text-lg text-gray-800">{{ $admin->name }}</p>
            <p class="text-gray-600 break-words mb-3">{{ $admin->email }}</p>
            <div class="flex space-x-4">
                <a href="{{ route('admin.admins.edit', $admin) }}" 
                   class="text-blue-600 hover:text-blue-800 font-semibold">
                    Modifier
                </a>
                <form action="{{ route('admin.admins.destroy', $admin) }}" method="POST" class="inline">
                    @csrf 
                    @method('DELETE')
                    <button type="submit" 
                            onclick="return confirm('Supprimer cet admin ?')" 
                            class="text-red-600 hover:text-red-800 font-semibold">
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-6 flex justify-center">
        {{ $admins->withQueryString()->links() }}
    </div>

</div>
@endsection
