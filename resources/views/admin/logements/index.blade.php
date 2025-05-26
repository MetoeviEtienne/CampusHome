@extends('layouts.admin')

@section('title', 'Logements à valider')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-6">Logements à valider</h2>

    @if($logements->isEmpty())
        <p class="text-gray-500">Aucun logement en attente de validation.</p>
    @else
        @foreach($logements as $logement)
            <div class="bg-white rounded-2xl shadow p-4 mb-4">
                <h3 class="text-xl font-semibold">{{ $logement->titre }}</h3>

                <!-- Affichage des photos -->
                <div class="mb-3 overflow-x-auto flex gap-2">
                    @foreach($logement->photos as $photo)
                        <img src="{{ asset('storage/' . $photo->chemin) }}" alt="Photo du logement" class="w-32 h-32 object-cover rounded">
                    @endforeach
                </div>

                <!-- Informations sur le logement -->
                <p><strong>Adresse:</strong> {{ $logement->adresse }}</p>
                <p><strong>Type:</strong> {{ ucfirst($logement->type) }}</p>
                <p><strong>Loyer:</strong> {{ number_format($logement->loyer, 0, ',', ' ') }} FCFA</p>
                <p><strong>Propriétaire:</strong> {{ $logement->proprietaire->name }}</p>

                <!-- Liens vers les documents du propriétaire -->
                <p>
                    <strong>Pièce d'identité :</strong>
                    @if($logement->piece_identite_path)
                        <a href="{{ asset('storage/' . $logement->piece_identite_path) }}" target="_blank" class="text-blue-600 underline hover:text-blue-800">
                            Voir le document
                        </a>
                    @else
                        <span class="text-gray-500">Non disponible</span>
                    @endif
                </p>

                <p>
                    <strong>Titre de propriété :</strong>
                    @if($logement->titre_propriete_path)
                        <a href="{{ asset('storage/' . $logement->titre_propriete_path) }}" target="_blank" class="text-blue-600 underline hover:text-blue-800">
                            Voir le document
                        </a>
                    @else
                        <span class="text-gray-500">Non disponible</span>
                    @endif
                </p>

                <!-- Formulaire de validation -->
                <div class="flex gap-2 mt-4">
                    <form method="POST" action="{{ route('admin.logements.valider', $logement) }}" class="valider-form">
                        @csrf
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                            ✅ Valider
                        </button>
                    </form>

                    <!-- Formulaire de rejet -->
                    <form method="POST" action="{{ route('admin.logements.rejecter', $logement) }}" class="rejecter-form">
                        @csrf
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                            ❌ Rejeter
                        </button>
                    </form>
                </div>

            </div>
        @endforeach

        <div class="mt-6">
            {{ $logements->links() }}
        </div>
    @endif
</div>
@endsection
