@extends('layouts.errors')

@section('title', '500 - Erreur serveur')

@section('content')
<div class="relative flex min-h-screen w-full items-center justify-center bg-gradient-to-br from-purple-50 via-white to-indigo-50 px-4">

    {{-- Décor flou --}}
    <div class="absolute -top-20 -left-20 h-72 w-72 rounded-full bg-purple-300 opacity-30 blur-3xl"></div>

    {{-- Carte principale --}}
    <div id="box"
         class="relative w-full max-w-lg overflow-hidden rounded-3xl bg-white/60 backdrop-blur-md shadow-xl ring-1 ring-white/40 transition-opacity duration-500">
        <div class="px-10 py-14 text-center">

            {{-- Logo (facultatif) --}}
            <div class="-mt-24 mb-6 flex justify-center">
                <img src="{{ asset('images/logo2.png') }}"
                     alt="Logo CampusHome"
                     class="h-24 w-24 rounded-full border-4 border-white shadow-lg" />
            </div>

            {{-- Icône erreur --}}
            <div class="mx-auto mb-6 flex h-24 w-24 items-center justify-center rounded-full bg-purple-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-purple-600" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 9v2m0 4h.01M12 3.25c-4.97 0-8.75 3.78-8.75 8.75S7.03 20.75 12 20.75 20.75 16.97 20.75 12 16.97 3.25 12 3.25z" />
                </svg>
            </div>

            {{-- Texte --}}
            <h1 class="text-6xl font-extrabold text-purple-600 mb-4 animate-bounce">500</h1>
            <h2 class="text-2xl font-semibold mb-4">Erreur interne du serveur</h2>
            <p class="text-gray-600 mb-8">
                Une erreur inattendue est survenue.<br>
                Veuillez réessayer plus tard ou contacter l’administration.
            </p>

            {{-- Bouton --}}
            <a href="{{ url('/') }}"
               class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition">
                Retour à l'accueil
            </a>

            {{-- Compte à rebours --}}
            <p class="mt-6 text-sm text-gray-500">
                Redirection automatique dans <span id="countdown">5</span> s…
            </p>
        </div>
    </div>
</div>

{{-- Script redirection + animation --}}
<script>
    let seconds = 5;
    const countdown = document.getElementById('countdown');
    const box = document.getElementById('box');

    const interval = setInterval(() => {
        seconds--;
        countdown.textContent = seconds;

        if (seconds === 1) {
            box.classList.add('opacity-70');
        }

        if (seconds <= 0) {
            clearInterval(interval);
            box.classList.add('opacity-0');
            setTimeout(() => {
                window.location.href = "{{ url('/') }}";
            }, 500);
        }
    }, 1000);
</script>
@endsection
