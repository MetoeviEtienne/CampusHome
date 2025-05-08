<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-blue-500 to-indigo-600 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-center text-3xl font-extrabold text-gray-900 mb-6">Créer un compte</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Nom complet')" />
                    <x-text-input id="name" class="mt-1 block w-full px-4 py-3 text-lg border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4 mb-4">
                    <x-input-label for="email" :value="__('Adresse e-mail')" />
                    <x-text-input id="email" class="mt-1 block w-full px-4 py-3 text-lg border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                 <!-- Téléphone -->
                 <div class="mt-4 mb-4">
                    <x-input-label for="phone" :value="__('Téléphone')" />
                    <x-text-input id="phone" class="mt-1 block w-full px-4 py-3 text-lg border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" type="phone" name="phone" :value="old('phone')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('téléphone')" class="mt-2" />
                </div>

                <!-- Ville -->
                <div class="mt-4 mb-4">
                    <x-input-label for="ville" :value="__('Ville')" />
                    <x-text-input id="ville" class="mt-1 block w-full px-4 py-3 text-lg border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" type="text" name="ville" :value="old('ville')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('ville')" class="mt-2" />
                </div>

                <div class="mt-4 mb-4">
                    <x-input-label for="role" :value="__('Rôle')" />
                    <select name="role" id="role" class="mt-1 block w-full px-4 py-3 text-lg border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                        <option value="student">Étudiant</option>
                        <option value="owner">Propriétaire</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                </div>
                

                <!-- Password -->
                <div class="mt-4 mb-4">
                    <x-input-label for="password" :value="__('Mot de passe')" />
                    <x-text-input id="password" class="mt-1 block w-full px-4 py-3 text-lg border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4 mb-6">
                    <x-input-label for="password_confirmation" :value="__('Confirmez le mot de passe')" />
                    <x-text-input id="password_confirmation" class="mt-1 block w-full px-4 py-3 text-lg border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between mt-6">
                    <a class="text-sm text-blue-600 hover:underline" href="{{ route('login') }}">
                        Déjà inscrit ?
                    </a>

                    <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 text-black font-bold py-3 px-6 rounded-lg text-lg">
                        {{ __('S\'inscrire') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
