@extends('layouts.naveshow')

@section('title', 'Créer une annonce de colocation')

@section('content')
<style>
    .bubble {
        position: absolute;
        border-radius: 9999px;
        opacity: 0.15;
        animation: float 8s ease-in-out infinite;
    }

    @keyframes float {
        0%   { transform: translateY(0px) translateX(0px) scale(1); }
        50%  { transform: translateY(-30px) translateX(10px) scale(1.1); }
        100% { transform: translateY(0px) translateX(0px) scale(1); }
    }
</style>

<div class="relative max-w-2xl mx-auto p-8 bg-white shadow-lg rounded-2xl mt-8 overflow-hidden">

    {{-- Bulles animées en arrière-plan --}}
    <div class="absolute inset-0 -z-10">
        <div class="bubble bg-blue-200 w-24 h-24 top-4 left-4"></div>
        <div class="bubble bg-blue-300 w-16 h-16 top-1/3 right-6 delay-200"></div>
        <div class="bubble bg-blue-400 w-20 h-20 bottom-10 left-10 delay-500"></div>
        <div class="bubble bg-blue-100 w-12 h-12 bottom-4 right-1/4 delay-300"></div>
    </div>

    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Créer une annonce de colocation</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-6 border border-red-300">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li class="mb-1">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- @if ($errors->has('limit'))
        <div class="bg-red-100 text-red-700 p-4 rounded mb-6 border border-red-300">
            <p>{{ $errors->first('limit') }}</p>
        </div>
    @endif --}}

    <form method="POST" action="{{ route('colocations.store', $reservation->id) }}" class="space-y-6 relative z-10">
        @csrf

        {{-- Nombre de places --}}
        <div>
            <label for="nombre_places" class="block text-sm font-medium text-gray-700 mb-1">Nombre de places disponibles</label>
            <input 
                type="number" 
                name="nombre_places" 
                id="nombre_places" 
                min="1" 
                max="2" 
                value="{{ old('nombre_places') }}" 
                class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" 
                placeholder="Max: 2"
                required
            >
        </div>

        {{-- Téléphone --}}
        <div>
            <label for="telephone" class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
            <input 
                type="text" 
                name="telephone" 
                id="telephone" 
                value="{{ old('telephone') }}" 
                class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" 
                placeholder="Ex: 0197000000"
                required
            >
        </div>

        {{-- Description --}}
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea 
                name="description" 
                id="description" 
                rows="5" 
                class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none" 
                placeholder="Décrivez ici le type de colocataire recherché, les conditions, etc."
                required
            >{{ old('description') }}</textarea>
        </div>

        {{-- Bouton --}}
        <div class="text-center">
            <button 
                type="submit" 
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-300"
            >
                Publier l’annonce
            </button>
        </div>
    </form>
</div>
@endsection
