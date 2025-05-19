@extends('layouts.proAd') <!-- Assure-toi que ce layout existe -->

@section('content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl w-full space-y-8 bg-white p-10 rounded-xl shadow-md">
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <h2 class="text-center text-3xl font-extrabold text-blue-600">Contactez l'administration</h2>

        {{-- <form action="{{ route('contact.store') }}" method="POST" class="space-y-6"> --}}
            @csrf

            <div>
                <label for="nom" class="block text-sm font-medium text-gray-700">Nom complet</label>
                <input type="text" name="nom" id="nom" required value="{{ old('nom') }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                @error('nom') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Adresse e-mail</label>
                <input type="email" name="email" id="email" required value="{{ old('email') }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="sujet" class="block text-sm font-medium text-gray-700">Sujet</label>
                <input type="text" name="sujet" id="sujet" required value="{{ old('sujet') }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                @error('sujet') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                <textarea name="message" id="message" rows="5" required
                          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('message') }}</textarea>
                @error('message') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition">
                    Envoyer le message
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
