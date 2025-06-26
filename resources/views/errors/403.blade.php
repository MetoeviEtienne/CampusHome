@extends('layouts.errors')

@section('title', '403 – Accès refusé')

@section('content')
<div class="relative flex min-h-screen w-full items-center justify-center bg-gradient-to-br from-red-50 via-white to-orange-50 px-4">

    {{-- Décor flou --}}
    <div class="absolute -bottom-20 -right-20 h-72 w-72 rounded-full bg-red-300 opacity-30 blur-3xl"></div>

    {{-- Carte principale --}}
    <div class="relative w-full max-w-lg overflow-hidden rounded-3xl bg-white/60 backdrop-blur-md shadow-xl ring-1 ring-white/40">
        <div class="px-10 py-14 text-center">

            {{-- Logo au-dessus --}}
            <div class="-mt-24 mb-6 flex justify-center">
                <img src="{{ asset('images/logo2.png') }}"
                     alt="Logo CampusHome"
                     class="h-24 w-24 rounded-full border-4 border-white shadow-lg" />
            </div>

            {{-- Icône d'erreur --}}
            <div class="mx-auto mb-6 flex h-24 w-24 items-center justify-center rounded-full bg-red-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-500" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 9v2m0 4h.01M12 3.25c-4.97 0-8.75 3.78-8.75 8.75S7.03 20.75 12 20.75 20.75 16.97 20.75 12 16.97 3.25 12 3.25z" />
                </svg>
            </div>

            {{-- Message --}}
            <h1 class="mb-2 text-6xl font-extrabold text-red-500">403</h1>
            <h2 class="mb-4 text-2xl font-semibold text-gray-800">Accès non autorisé</h2>

            <p class="mx-auto mb-8 max-w-xs text-gray-600">
                Vous n'avez pas les droits nécessaires pour accéder à cette page.<br>
                Veuillez contacter l’administration si vous pensez que c’est une erreur.
            </p>

            {{-- Boutons --}}
            <div class="flex flex-col items-center gap-3 sm:flex-row sm:justify-center">
                <a href="{{ url('/') }}"
                   class="inline-block rounded-lg bg-blue-600 px-6 py-3 text-white font-semibold shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition">
                    Retour à l’accueil
                </a>

                <a href="{{ url()->previous() }}"
                   class="text-sm font-medium text-blue-600 underline underline-offset-2 hover:text-blue-800">
                    Page précédente
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
