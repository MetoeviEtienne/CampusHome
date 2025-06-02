@extends('layouts.admin')

@section('content')
<h2 class="text-3xl text-center font-extrabold mb-8 text-gray-800">Ajouter un administrateur</h2>

<form action="{{ route('admin.admins.store') }}" method="POST" class="bg-white p-8 rounded-lg shadow-lg max-w-lg mx-auto">
    @csrf

    <div class="mb-6">
        <label for="name" class="block text-gray-700 font-semibold mb-2">Nom</label>
        <input 
            id="name" 
            type="text" 
            name="name" 
            required
            class="w-full border border-gray-300 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
            placeholder="Entrez le nom complet"
        >
    </div>

    <div class="mb-6">
        <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
        <input 
            id="email" 
            type="email" 
            name="email" 
            required
            class="w-full border border-gray-300 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
            placeholder="exemple@abtasi.com"
        >
    </div>

    <div class="mb-6">
        <label for="password" class="block text-gray-700 font-semibold mb-2">Mot de passe</label>
        <input 
            id="password" 
            type="password" 
            name="password" 
            required
            class="w-full border border-gray-300 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
            placeholder="••••••••"
        >
    </div>

    <div class="mb-8">
        <label for="password_confirmation" class="block text-gray-700 font-semibold mb-2">Confirmation du mot de passe</label>
        <input 
            id="password_confirmation" 
            type="password" 
            name="password_confirmation" 
            required
            class="w-full border border-gray-300 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
            placeholder="••••••••"
        >
    </div>

    <button type="submit" 
            class="w-full bg-green-600 text-white font-bold py-3 rounded-lg hover:bg-green-700 transition-shadow shadow-md hover:shadow-lg">
        Créer
    </button>
</form>
@endsection
