@extends('layouts.custom-layout')

@section('title', 'Réinitialiser votre mot de passe')

@section('content')

    <h2 class="text-center text-3xl font-extrabold text-white mb-6">{{ __('Réinitialiser votre mot de passe') }}</h2>

    <div class="mb-4 text-sm text-gray-600">
        {{ __("Vous avez oublié votre mot de passe ? Pas de problème. Indiquez-nous votre adresse e-mail et nous vous enverrons un lien pour réinitialiser votre mot de passe.") }}
    </div>

    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Adresse e-mail</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                class="mt-1 block w-full px-4 py-3 text-lg border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
            @error('email')
                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Bouton -->
        <div class="flex items-center justify-between mt-6">
            <button type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg text-lg transition ease-in-out duration-150">
                {{ __('Envoyer le lien de réinitialisation') }}
            </button>
        </div>
    </form>

@endsection
