@extends('layouts.naveshow')

@section('header')
    <h2 class="text-3xl font-extrabold text-gray-900 dark:text-gray-100 flex items-center space-x-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A9 9 0 1118.879 6.196 9 9 0 015.121 17.804z" />
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 12v.01" />
        </svg>
        <span>{{ __('Profil Utilisateur') }}</span>
    </h2>
@endsection

@section('content')
    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <section class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-8 transition-shadow hover:shadow-2xl">
                <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-200 mb-6 border-b border-gray-200 dark:border-gray-700 pb-3">
                    Informations personnelles
                </h3>
                <div class="max-w-2xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </section>

            <section class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-8 transition-shadow hover:shadow-2xl">
                <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-200 mb-6 border-b border-gray-200 dark:border-gray-700 pb-3">
                    Modifier le mot de passe
                </h3>
                <div class="max-w-2xl">
                    @include('profile.partials.update-password-form')
                </div>
            </section>

            <section class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-8 transition-shadow hover:shadow-2xl">
                <h3 class="text-xl font-semibold text-red-600 mb-6 border-b border-red-400 pb-3">
                    Supprimer le compte
                </h3>
                <div class="max-w-2xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </section>

        </div>
    </div>
@endsection
