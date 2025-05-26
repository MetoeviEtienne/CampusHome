@extends('layouts.proprietaire')

@section('title', 'Ajouter un logement')

@section('content')
<style>
    /* Animation de pulse légère */
    @keyframes pulseLight {
        0%, 100% {
            box-shadow: 0 0 8px rgba(253, 224, 71, 0.4);
        }
        50% {
            box-shadow: 0 0 16px rgba(253, 224, 71, 0.8);
        }
    }

    .pulse-animation {
        animation: pulseLight 3s ease-in-out infinite;
    }
</style>

<div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Ajouter un nouveau logement</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- FORMULAIRE : 2 colonnes -->
        <div class="md:col-span-2">
            @if ($errors->any())
                <div class="mb-4 text-red-600">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('proprietaire.logements.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- ... (le formulaire reste inchangé, je ne le copie pas ici pour alléger) ... -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Tous les champs comme avant -->
                    <div>
                        <label for="titre" class="block font-medium">Titre *</label>
                        <input type="text" id="titre" name="titre" value="{{ old('titre') }}" required class="w-full border rounded p-2">
                    </div>
                    <div>
                        <label for="adresse" class="block font-medium">Ville *</label>
                        <input type="text" id="adresse" name="adresse" value="{{ old('adresse') }}" required class="w-full border rounded p-2">
                    </div>
                    <div>
                        <label for="type" class="block font-medium">Type *</label>
                        <select id="type" name="type" required class="w-full border rounded p-2">
                            <option value="">-- Sélectionner --</option>
                            <option value="studio">Studio</option>
                            <option value="appartement">Appartement</option>
                            <option value="chambre">Chambre</option>
                            <option value="colocation">Colocation</option>
                        </select>
                    </div>
                    <div>
                        <label for="nombre_chambres" class="block font-medium">Nombre de chambres *</label>
                        <input type="number" id="nombre_chambres" name="nombre_chambres" value="{{ old('nombre_chambres') }}" required class="w-full border rounded p-2">
                    </div>
                    <div>
                        <label for="superficie" class="block font-medium">Superficie (m²) *</label>
                        <input type="number" step="0.01" id="superficie" name="superficie" value="{{ old('superficie') }}" required class="w-full border rounded p-2">
                    </div>
                    <div>
                        <label for="loyer" class="block font-medium">Loyer mensuel (FCFA) *</label>
                        <input type="number" step="0.01" id="loyer" name="loyer" value="{{ old('loyer') }}" required class="w-full border rounded p-2">
                    </div>
                    <div>
                        <label for="charges" class="block font-medium">Charges mensuelles (FCFA)</label>
                        <input type="number" step="0.01" id="charges" name="charges" value="{{ old('charges', 0) }}" class="w-full border rounded p-2">
                    </div>
                    <div>
                        <label for="disponibilite" class="block font-medium">Date de disponibilité *</label>
                        <input type="date" id="disponibilite" name="disponibilite" value="{{ old('disponibilite') }}" required class="w-full border rounded p-2">
                    </div>
                </div>

                <div class="mt-4">
                    <label for="description" class="block font-medium">Description</label>
                    <textarea id="description" name="description" rows="4" class="w-full border rounded p-2">{{ old('description') }}</textarea>
                </div>

                <div class="mt-4">
                    <label for="piece_identite" class="block font-medium">Pièce d'identité/CIP du propriétaire *</label>
                    <input type="file" id="piece_identite" name="piece_identite" accept="image/*,application/pdf" required class="w-full border rounded p-2">
                    <p class="text-sm text-gray-500 mt-1">Format image ou PDF accepté.</p>
                </div>

                <div class="mt-4">
                    <label for="titre_propriete" class="block font-medium">Taxe foncière / Titre de propriété *</label>
                    <input type="file" id="titre_propriete" name="titre_propriete" accept="image/*,application/pdf" required class="w-full border rounded p-2">
                    <p class="text-sm text-gray-500 mt-1">Format image ou PDF accepté.</p>
                </div>

                <div class="mt-4">
                    <label for="photos" class="block font-medium">Photos *</label>
                    <input type="file" id="photos" name="photos[]" multiple accept="image/*" class="w-full">
                    <p class="text-sm text-gray-500 mt-1">Vous pouvez sélectionner plusieurs fichiers.</p>
                </div>

                <div class="mt-6">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                        Enregistrer le logement
                    </button>
                </div>
            </form>
        </div>

        <!-- AVERTISSEMENT & LISTE DES PIÈCES : 1 colonne avec animation -->
        <div class="bg-yellow-50 border border-yellow-300 rounded p-6 text-yellow-900 shadow-sm sticky top-24 pulse-animation">
            <h3 class="font-semibold text-lg mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Informations importantes
            </h3>

            <p class="mb-4">
                Pour ajouter un logement, merci de fournir impérativement les documents suivants :
            </p>

            <ul class="list-disc list-inside space-y-2 mb-4">
                <li><strong>Pièce d'identité du propriétaire :</strong> obligatoire pour vérifier l'identité.</li>
                <li><strong>Taxe foncière ou titre de propriété :</strong> prouvant la propriété du logement.</li>
                <li><strong>Photos récentes du logement :</strong> plusieurs photos nettes et représentatives.</li>
            </ul>

            <p class="text-sm italic text-yellow-800">
                Formats acceptés : JPG, PNG, PDF.<br>
                Taille maximale par fichier : 2 Mo.
            </p>
        </div>
    </div>
</div>
@endsection
