@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <h2 class="text-3xl font-bold mb-8 text-gray-800 text-center md:text-left">
        Tous les avis des étudiants
    </h2>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-md shadow-sm border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    @if($avis->isEmpty())
        <p class="text-center text-gray-500 italic py-8">Aucun avis trouvé.</p>
    @else
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($avis as $item)
                <div class="bg-white rounded-lg shadow-md p-6 flex flex-col justify-between hover:shadow-lg transition-shadow duration-300">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2 truncate" title="{{ $item->logement->titre ?? 'N/A' }}">
                            {{ $item->logement->titre ?? 'Logement inconnu' }}
                        </h3>
                        <p class="text-sm text-gray-600 mb-1">
                            <span class="font-semibold">Propriétaire:</span> {{ $item->logement->proprietaire->name ?? 'N/A' }}
                        </p>
                        <p class="text-sm text-gray-600 mb-3">
                            <span class="font-semibold">Auteur:</span> {{ $item->auteur->name }}
                        </p>
                        <p class="text-gray-700 mb-4 line-clamp-4" title="{{ $item->commentaire }}">
                            {{ $item->commentaire }}
                        </p>
                    </div>
                    <div class="flex items-center justify-between">
                        <span 
                            class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                                {{ $item->verifie ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $item->verifie ? 'Vérifié' : 'Non vérifié' }}
                        </span>

                        @if(!$item->verifie)
                            <form method="POST" action="{{ route('admin.avis.verifier', $item) }}">
                                @csrf
                                @method('PATCH')
                                <button 
                                    type="submit" 
                                    class="bg-blue-600 text-white px-3 py-1 rounded-md text-xs font-semibold hover:bg-blue-700 transition"
                                >
                                    Vérifier
                                </button>
                            </form>
                        @else
                            <span class="text-gray-400 text-xs italic">Aucune action</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
