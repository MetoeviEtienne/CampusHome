@extends('layouts.custom-layout')

@section('title', 'Confirmer votre mot de passe')

@section('content')

    <h2 class="text-center text-3xl font-extrabold text-gray-900 mb-6">Confirmer votre mot de passe</h2>

    <div class="mb-4 text-sm text-gray-600">
        {{ __("Il s'agit d'une zone sécurisée de l'application. Veuillez confirmer votre mot de passe avant de continuer.") }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
            <input id="password" name="password" type="password" required autocomplete="current-password"
                class="mt-1 block w-full px-4 py-3 text-lg border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
            @error('password')
                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-black font-bold py-3 px-6 rounded-lg text-lg transition ease-in-out duration-150">
                Confirmer
            </button>
        </div>
    </form>

@endsection
