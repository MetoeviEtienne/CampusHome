@extends('layouts.admin')

@section('content')
<h2 class="text-xl font-bold mb-4">Ajouter un administrateur</h2>

<form action="{{ route('admin.admins.store') }}" method="POST" class="bg-white p-6 rounded shadow w-full md:w-1/2">
    @csrf

    <div class="mb-4">
        <label class="block mb-1">Nom</label>
        <input type="text" name="name" class="w-full border px-4 py-2 rounded" required>
    </div>

    <div class="mb-4">
        <label class="block mb-1">Email</label>
        <input type="email" name="email" class="w-full border px-4 py-2 rounded" required>
    </div>

    <div class="mb-4">
        <label class="block mb-1">Mot de passe</label>
        <input type="password" name="password" class="w-full border px-4 py-2 rounded" required>
    </div>

    <div class="mb-4">
        <label class="block mb-1">Confirmation du mot de passe</label>
        <input type="password" name="password_confirmation" class="w-full border px-4 py-2 rounded" required>
    </div>

    <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Créer</button>
</form>
@endsection
