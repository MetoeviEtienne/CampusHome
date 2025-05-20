@extends('layouts.custom-layout')

@section('title', 'Vérifiez votre e-mail')

@section('content')
    <h2 class="text-center text-3xl font-extrabold text-gray-900 mb-6">Vérifiez votre e-mail</h2>

    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __("Merci de vous être inscrit ! Avant de commencer, pourriez-vous vérifier votre adresse e-mail en cliquant sur le lien que nous venons de vous envoyer ? Si vous n'avez pas reçu l'email, nous serons heureux de vous en envoyer un autre.") }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ __("Un nouveau lien de vérification a été envoyé à l'adresse e-mail que vous avez fournie lors de l'inscription.") }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <!-- Formulaire renvoyer email de vérification -->
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" 
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg text-lg transition duration-150 ease-in-out">
                {{ __("Renvoyer l'email de vérification") }}
            </button>
        </form>

        <!-- Formulaire déconnexion -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                {{ __('Se déconnecter') }}
            </button>
        </form>
    </div>
@endsection
