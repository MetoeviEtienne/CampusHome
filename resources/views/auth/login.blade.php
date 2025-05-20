@extends('layouts.custom-layout')

@section('title', 'Se connecter')

@section('content')

    {{-- Session status --}}
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <h2 class="text-center text-3xl font-extrabold text-gray-900 mb-6">Se connecter</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Adresse e-mail</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                   class="mt-1 block w-full px-4 py-3 text-lg border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            @error('email')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
            <input id="password" name="password" type="password" required autocomplete="current-password"
                   class="mt-1 block w-full px-4 py-3 text-lg border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            @error('password')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember -->
        <div class="mb-6">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" name="remember" type="checkbox"
                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" />
                <span class="ml-2 text-sm text-gray-700">Se souvenir de moi</span>
            </label>
        </div>

        <!-- Actions (bouton Se connecter + lien mot de passe oublié) -->
        <div class="flex items-center justify-between mb-2">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">
                    Mot de passe oublié ?
                </a>
            @endif

            <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg text-lg transition ease-in-out duration-150">
                Se connecter
            </button>
        </div>
    </form>

    {{-- Lien simple S'inscrire sans effet ni background --}}
    <div class="text-center mt-2">
        <a href="{{ route('register') }}" class="text-gray-800 text-base no-underline">
            S'inscrire
        </a>
    </div>

@endsection
