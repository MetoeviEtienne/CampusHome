@extends('layouts.custom-layout')

@section('title', 'Se connecter')

@section('content')
    @if (session('status'))
        <div class="mb-4 text-green-100 bg-green-700 px-4 py-2 rounded">
            {{ session('status') }}
        </div>
    @endif

    <h2 class="text-center text-3xl font-extrabold text-white mb-6">Se connecter</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-white">Adresse e-mail</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                   class="mt-1 block w-full px-4 py-3 text-lg text-gray-900 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" />
            @error('email')
                <p class="text-red-100 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4 relative">
            <label for="password" class="block text-sm font-medium text-white">Mot de passe</label>
            <input id="password" name="password" type="password" required
                   class="mt-1 block w-full px-4 py-3 pr-10 text-lg text-gray-900 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400" />
            <button type="button" onclick="togglePassword()" class="absolute top-10 right-3 text-white hover:text-indigo-200">
                <i id="passwordToggleIcon" class="fa-solid fa-eye"></i>
            </button>
            @error('password')
                <p class="text-red-100 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember -->
        <div class="mb-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" name="remember" type="checkbox"
                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring focus:ring-indigo-400" />
                <span class="ml-2 text-sm text-white">Se souvenir de moi</span>
            </label>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between mb-6">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-white hover:underline">Mot de passe oublié ?</a>
            @endif

            <button type="submit"
                    class="bg-white text-indigo-700 hover:bg-indigo-100 font-semibold px-6 py-2 rounded transition">
                Se connecter
            </button>
        </div>
    </form>

    <div class="text-center mt-4">
        <a href="{{ route('register') }}" class="text-white hover:underline">Pas encore de compte ? S'inscrire</a>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('passwordToggleIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
@endsection
