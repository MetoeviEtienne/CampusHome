@extends('layouts.admin')

@section('content')
<div class="container mx-auto py-6 px-4">
    <h2 class="text-3xl font-extrabold text-center text-gray-800 mb-8">Contrats de location</h2>

    @if($reservations->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($reservations as $res)
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow flex flex-col justify-between">
                    <div>
                        <h3 class="text-xl font-semibold text-yellow-600 mb-2">{{ $res->logement->titre ?? 'Logement inconnu' }}</h3>
                        <p class="text-gray-700"><span class="font-semibold">Étudiant :</span> {{ $res->etudiant->name ?? '-' }}</p>
                        <p class="text-gray-700"><span class="font-semibold">Durée :</span> 
                            {{ \Carbon\Carbon::parse($res->date_debut)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($res->date_fin)->format('d/m/Y') }}
                        </p>
                    </div>

                    <div class="mt-4 flex items-center justify-between">
                        @if($res->contrat)
                            <a href="{{ asset('storage/' . $res->contrat) }}" target="_blank" 
                               class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md transition">
                                Voir contrat
                            </a>
                        @else
                            <span class="text-gray-400 italic">Aucun contrat</span>
                        @endif

                        @if($res->contrat_signe)
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">Signé</span>
                        @else
                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">Non signé</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $reservations->links() }}
        </div>
    @else
        <p class="text-center text-gray-600 italic text-lg">Aucun contrat de location trouvé.</p>
    @endif
</div>
@endsection
