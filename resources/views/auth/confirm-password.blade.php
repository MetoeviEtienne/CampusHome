<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-blue-500 to-indigo-600 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-center text-3xl font-extrabold text-gray-900 mb-6">Confirmer votre mot de passe</h2>

            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Il s\'agit d\'une zone sécurisée de l\'application. Veuillez confirmer votre mot de passe avant de continuer.') }}
            </div>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Mot de passe')" />

                    <x-text-input id="password" class="mt-1 block w-full" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex justify-end mt-6">
                    <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 text-black font-bold py-3 px-6 rounded-lg text-lg">
                        {{ __('Confirmer') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
