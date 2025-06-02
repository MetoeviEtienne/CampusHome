@extends('layouts.proAd')

@section('content')
<div class="min-h-screen bg-gradient-to-tr from-blue-50 to-blue-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl p-8 sm:p-10 space-y-8">
        
        {{-- Message de succès --}}
        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-md text-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- Bouton retour --}}
        <div>
            <a href="{{ url('/') }}" 
               class="text-sm text-gray-500 hover:text-blue-600 transition duration-200 inline-flex items-center space-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                <span>Retour au tableau de bord</span>
            </a>
        </div>

        {{-- Titre --}}
        <h2 class="text-center text-3xl font-bold text-blue-600">Contactez l'administration</h2>

        {{-- Formulaire --}}
        <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
            @csrf

            {{-- Nom complet --}}
            <div>
                <label for="nom" class="block text-sm font-semibold text-gray-700">Nom complet</label>
                <input type="text" name="nom" id="nom" required value="{{ old('nom') }}"
                       class="w-full mt-1 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150">
                @error('nom') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700">Adresse e-mail</label>
                <input type="email" name="email" id="email" required value="{{ old('email') }}"
                       class="w-full mt-1 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150">
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Sujet --}}
            <div>
                <label for="sujet" class="block text-sm font-semibold text-gray-700">Sujet</label>
                <input type="text" name="sujet" id="sujet" required value="{{ old('sujet') }}"
                       class="w-full mt-1 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150">
                @error('sujet') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Message --}}
            <div>
                <label for="message" class="block text-sm font-semibold text-gray-700">Message</label>
                <textarea name="message" id="message" rows="5" required
                          class="w-full mt-1 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150">{{ old('message') }}</textarea>
                @error('message') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Bouton submit --}}
            <div class="text-right">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg shadow-sm transition duration-200">
                    Envoyer le message
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
