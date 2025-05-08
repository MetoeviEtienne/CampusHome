<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-blue-500 to-indigo-600 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-center text-3xl font-extrabold text-gray-900 mb-6">{{ __('Réinitialiser votre mot de passe') }}</h2>

            <!-- Information -->
            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Vous avez oublié votre mot de passe ? Pas de problème. Indiquez-nous votre adresse e-mail et nous vous enverrons un lien pour réinitialiser votre mot de passe.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Formulaire -->
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Adresse e-mail')" />
                    <x-text-input id="email" class="mt-1 block w-full px-4 py-3 text-lg border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Bouton de réinitialisation -->
                <div class="flex items-center justify-between mt-6">
                    <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg text-lg">
                        {{ __('Envoyer le lien de réinitialisation') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
