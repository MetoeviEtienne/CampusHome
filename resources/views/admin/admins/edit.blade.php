@extends('layouts.admin')

@section('content')
<div class="max-w-lg mx-auto bg-white p-8 rounded-xl shadow-lg border border-gray-200">
    <h1 class="text-3xl font-extrabold text-gray-900 mb-8 text-center">Modifier l'administrateur</h1>

    <!-- Messages succès / erreur -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-md border border-green-200 text-center font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.admins.update', $admin) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Nom -->
        <div>
            <label for="name" class="block mb-2 text-sm font-semibold text-gray-700">Nom</label>
            <input 
                type="text" 
                name="name" 
                id="name" 
                value="{{ old('name', $admin->name) }}" 
                required
                class="w-full px-5 py-3 rounded-lg border border-gray-300 shadow-sm placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
                placeholder="Entrez le nom complet"
            >
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block mb-2 text-sm font-semibold text-gray-700">Email</label>
            <input 
                type="email" 
                name="email" 
                id="email" 
                value="{{ old('email', $admin->email) }}" 
                required
                class="w-full px-5 py-3 rounded-lg border border-gray-300 shadow-sm placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
                placeholder="exemple@domaine.com"
            >
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Mot de passe -->
        <div>
            <label for="password" class="block mb-2 text-sm font-semibold text-gray-700">Mot de passe (optionnel)</label>
            <input 
                type="password" 
                name="password" 
                id="password" 
                class="w-full px-5 py-3 rounded-lg border border-gray-300 shadow-sm placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
                placeholder="Laissez vide pour ne pas modifier"
            >
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirmation mot de passe -->
        <div>
            <label for="password_confirmation" class="block mb-2 text-sm font-semibold text-gray-700">Confirmer le mot de passe</label>
            <input 
                type="password" 
                name="password_confirmation" 
                id="password_confirmation" 
                class="w-full px-5 py-3 rounded-lg border border-gray-300 shadow-sm placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
                placeholder="Confirmez le mot de passe"
            >
        </div>

        <!-- Bouton -->
        <div>
            <button 
                type="submit" 
                class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold shadow-md hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
            >
                Mettre à jour
            </button>
        </div>
    </form>
</div>
@endsection
