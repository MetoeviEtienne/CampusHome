@extends('layouts.custom-layout')

@section('title', 'Créer un compte')

@section('content')

<h2 class="text-center text-3xl font-extrabold text-gray-900 mb-6">Créer un compte</h2>

<form method="POST" action="{{ route('register') }}" id="registerForm">
    @csrf

    <input type="hidden" name="current_step" id="current_step" value="1" />

  <div class="step" id="step1">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
        <!-- Colonne gauche -->
        <div>
            <label for="name" class="block text-gray-700 font-semibold mb-2">Nom complet</label>
            <input id="name" name="name" type="text" required autofocus autocomplete="name"
                value="{{ old('name') }}"
                class="block w-full px-4 py-3 text-lg border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
            @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror

            <label for="email" class="block text-gray-700 font-semibold mt-6 mb-2">Adresse e-mail</label>
            <input id="email" name="email" type="email" required autocomplete="username"
                value="{{ old('email') }}"
                class="block w-full px-4 py-3 text-lg border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
            @error('email')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Colonne droite -->
        <div>
            <label for="phone" class="block text-gray-700 font-semibold mb-2">Téléphone</label>
            <input id="phone" name="phone" type="text" required
                value="{{ old('phone') }}"
                class="block w-full px-4 py-3 text-lg border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
            @error('phone')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror

            <label for="ville" class="block text-gray-700 font-semibold mt-6 mb-2">Ville</label>
            <input id="ville" name="ville" type="text" required
                value="{{ old('ville') }}"
                class="block w-full px-4 py-3 text-lg border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
            @error('ville')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="flex flex-col items-end space-y-2">
        <button type="button" onclick="nextStep()" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg text-lg transition duration-150 ease-in-out">
            Suivant
        </button>
        <a href="/login" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
            Déjà un compte ?
        </a>
    </div>
</div>

    <!-- Étape 2 -->
    <div class="step hidden" id="step2">
        <div class="mb-4">
            <label for="role" class="block text-gray-700 font-semibold mb-2">Vous êtes</label>
            <select id="role" name="role" required
                class="block w-full px-4 py-3 text-lg border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">-- Choisissez un rôle --</option>
                <option value="student" @if(old('role')=='student') selected @endif>Étudiant</option>
                <option value="owner" @if(old('role')=='owner') selected @endif>Propriétaire</option>
            </select>
            @error('role')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-between">
            <button type="button" onclick="prevStep()" class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-3 px-6 rounded-lg text-lg transition duration-150 ease-in-out">
                Précédent
            </button>
            <button type="button" onclick="nextStep()" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg text-lg transition duration-150 ease-in-out">
                Suivant
            </button>
        </div>
    </div>

    <!-- Étape 3 -->
    <div class="step hidden" id="step3">
        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-semibold mb-2">Mot de passe</label>
            <input id="password" name="password" type="password" required autocomplete="new-password"
                class="block w-full px-4 py-3 text-lg border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
            @error('password')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="password_confirmation" class="block text-gray-700 font-semibold mb-2">Confirmez le mot de passe</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                class="block w-full px-4 py-3 text-lg border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
            @error('password_confirmation')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-between">
            <button type="button" onclick="prevStep()" class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-3 px-6 rounded-lg text-lg transition duration-150 ease-in-out">
                Précédent
            </button>

            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg text-lg transition duration-150 ease-in-out">
                S'inscrire
            </button>
        </div>
    </div>
</form>

<script>
    let currentStep = 1;
    function showStep(step) {
        document.querySelectorAll('.step').forEach((el) => {
            el.classList.add('hidden');
        });
        document.getElementById('step' + step).classList.remove('hidden');
        document.getElementById('current_step').value = step;
        currentStep = step;
    }

    function nextStep() {
        if(currentStep < 3) {
            showStep(currentStep + 1);
        }
    }

    function prevStep() {
        if(currentStep > 1) {
            showStep(currentStep - 1);
        }
    }

    // Affiche la première étape au chargement
    document.addEventListener('DOMContentLoaded', () => {
        showStep(1);
    });
</script>

@endsection
