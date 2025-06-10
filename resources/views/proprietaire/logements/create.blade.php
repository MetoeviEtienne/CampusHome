@extends('layouts.proprietaire')

@section('title', 'Ajouter un logement')

@section('content')
<style>
    /* Animation de pulse légère */
    @keyframes pulseLight {
        0%, 100% {
            box-shadow: 0 0 12px rgba(253, 224, 71, 0.4);
        }
        50% {
            box-shadow: 0 0 24px rgba(253, 224, 71, 0.8);
        }
    }
    .pulse-animation {
        animation: pulseLight 3s ease-in-out infinite;
    }

    /* Focus custom pour inputs */
    input:focus, select:focus, textarea:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.5); /* bleu tailwind-500 */
        border-color: #3b82f6;
        transition: box-shadow 0.3s ease;
    }
</style>

<div class="max-w-7xl mx-auto bg-white p-8 rounded-lg shadow-lg">
    <h2 class="text-3xl font-extrabold mb-8 text-gray-800 border-b pb-3">Ajouter un nouveau logement</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
        <!-- FORMULAIRE (2 colonnes) -->
        <div class="md:col-span-2">
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-300 rounded text-red-700 shadow-sm">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('proprietaire.logements.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="titre" class="block mb-1 font-semibold text-gray-700">Titre <span class="text-red-500">*</span></label>
                        <input type="text" id="titre" name="titre" placeholder="Ex: Studio meublé à Fidjrossè" value="{{ old('titre') }}" required
                               class="w-full border border-gray-300 rounded-lg p-3 placeholder-gray-400 focus:ring-0">
                    </div>

                    <div>
                        <label for="adresse" class="block mb-1 font-semibold text-gray-700">Ville <span class="text-red-500">*</span></label>
                        <input type="text" id="adresse" name="adresse" value="{{ old('adresse') }}" required
                               class="w-full border border-gray-300 rounded-lg p-3 placeholder-gray-400 focus:ring-0">
                    </div>

                    <div>
                        <label for="quartier" class="block mb-1 font-semibold text-gray-700">Quartier<span class="text-red-500">*</span></label>
                        <input type="text" id="quartier" name="quartier" value="{{ old('quartier') }}" required
                               class="w-full border border-gray-300 rounded-lg p-3 placeholder-gray-400 focus:ring-0">
                    </div>

                    <div>
                        <label for="type" class="block mb-1 font-semibold text-gray-700">Type <span class="text-red-500">*</span></label>
                        <select id="type" name="type" required
                                class="w-full border border-gray-300 rounded-lg p-3 bg-white cursor-pointer focus:ring-0">
                            <option value="" disabled selected>Sélectionner</option>
                            <option value="entrée couchée">Entrée couchée</option>
                            {{-- <option value="appartement">Appartement</option> --}}
                            <option value="chambre">Chambre</option>
                            {{-- <option value="colocation">Colocation</option> --}}
                        </select>
                    </div>

                    {{-- <div>
                        <label for="nombre_chambres" class="block mb-1 font-semibold text-gray-700">Nombre de chambres <span class="text-red-500">*</span></label>
                        <input type="number" id="nombre_chambres" name="nombre_chambres" value="{{ old('nombre_chambres') }}" required min="0"
                               class="w-full border border-gray-300 rounded-lg p-3 placeholder-gray-400 focus:ring-0">
                    </div> --}}

                    <div>
                        <label for="superficie" class="block mb-1 font-semibold text-gray-700">Superficie (m²) <span class="text-red-500">*</span></label>
                        <input type="number" step="0.01" id="superficie" name="superficie" value="{{ old('superficie') }}" required min="0"
                               class="w-full border border-gray-300 rounded-lg p-3 placeholder-gray-400 focus:ring-0">
                    </div>

                    <div>
                        <label for="loyer" class="block mb-1 font-semibold text-gray-700">Loyer mensuel (FCFA) <span class="text-red-500">*</span></label>
                        <input type="number" step="0.01" id="loyer" name="loyer" value="{{ old('loyer') }}" required min="0"
                               class="w-full border border-gray-300 rounded-lg p-3 placeholder-gray-400 focus:ring-0">
                    </div>

                     <div>
                        <label for="numMaison" class="block mb-1 font-semibold text-gray-700">Numéro de la maison<span class="text-red-500">*</span></label>
                        <input type="text" step="0.01" id="numMaison" name="numMaison" value="{{ old('numMaison') }}" required min="0"
                               class="w-full border border-gray-300 rounded-lg p-3 placeholder-gray-400 focus:ring-0">
                    </div>

                     <div>
                        <label for="numChambre" class="block mb-1 font-semibold text-gray-700">Numéro de la chambre<span class="text-red-500">*</span></label>
                        <input type="number" step="0.01" id="umChambre" name="numChambre" value="{{ old('umChambre') }}" required min="0"
                               class="w-full border border-gray-300 rounded-lg p-3 placeholder-gray-400 focus:ring-0">
                    </div>

                    {{-- <div>
                        <label for="charges" class="block mb-1 font-semibold text-gray-700">Charges mensuelles (FCFA)</label>
                        <input type="number" step="0.01" id="charges" name="charges" value="{{ old('charges', 0) }}" min="0"
                               class="w-full border border-gray-300 rounded-lg p-3 placeholder-gray-400 focus:ring-0">
                    </div> --}}

                    <div>
                        <label for="disponibilite" class="block mb-1 font-semibold text-gray-700">Date de disponibilité <span class="text-red-500">*</span></label>
                        <input type="date" id="disponibilite" name="disponibilite" value="{{ old('disponibilite') }}" required
                               class="w-full border border-gray-300 rounded-lg p-3 placeholder-gray-400 focus:ring-0">
                    </div>
                </div>

                <div>
                    <label for="description" class="block mb-1 font-semibold text-gray-700">Description</label>
                    <textarea id="description" name="description" rows="5" placeholder = "Décrire un peu le logement ici" required
                              class="w-full border border-gray-300 rounded-lg p-3 placeholder-gray-400 focus:ring-0 resize-none">{{ old('description') }}</textarea>
                </div>

                <div>
                    <label for="piece_identite" class="block mb-1 font-semibold text-gray-700">Pièce d'identité/CIP du propriétaire <span class="text-red-500">*</span></label>
                    <input type="file" id="piece_identite" name="piece_identite" accept="image/*,application/pdf" required
                           class="w-full border border-gray-300 rounded-lg p-2 cursor-pointer focus:ring-0">
                    <p class="mt-1 text-sm text-gray-500 italic">Formats acceptés : image ou PDF.</p>
                </div>

                <div>
                    <label for="titre_propriete" class="block mb-1 font-semibold text-gray-700">Taxe foncière / Titre de propriété <span class="text-red-500">*</span></label>
                    <input type="file" id="titre_propriete" name="titre_propriete" accept="image/*,application/pdf" required
                           class="w-full border border-gray-300 rounded-lg p-2 cursor-pointer focus:ring-0">
                    <p class="mt-1 text-sm text-gray-500 italic">Formats acceptés : image ou PDF.</p>
                </div>

                <div>
                    <label for="photos" class="block mb-1 font-semibold text-gray-700">Photos <span class="text-red-500">*</span></label>
                    <input type="file" id="photos" name="photos[]" multiple accept="image/*"
                           class="w-full border border-gray-300 rounded-lg p-2 cursor-pointer focus:ring-0">
                    <p class="mt-1 text-sm text-gray-500 italic">Plusieurs photos possibles.</p>
                </div>

                <div>
                    <button type="submit" 
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg shadow-lg transition duration-300">
                        Enregistrer le logement
                    </button>
                </div>
            </form>
        </div>

        <!-- AVERTISSEMENT & LISTE DES PIÈCES : 1 colonne -->
        <aside class="bg-yellow-50 border border-yellow-300 rounded-lg p-6 text-yellow-900 shadow-md sticky top-24 pulse-animation select-none">
            <h3 class="font-extrabold text-xl mb-5 flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-yellow-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Informations importantes
            </h3>

            <p class="mb-6 font-semibold leading-relaxed">
                Merci de fournir impérativement les documents suivants pour l'ajout d'un logement :
            </p>

            <ul class="list-disc list-inside space-y-3 text-yellow-800 font-medium">
                <li>Pièce d'identité du propriétaire (obligatoire).</li>
                <li>Taxe foncière ou titre de propriété (preuve de propriété).</li>
                <li>Photos récentes et nettes du logement (plusieurs).</li>
            </ul>

            <p class="mt-6 text-sm italic text-yellow-900 opacity-80">
                Formats acceptés : JPG, PNG, PDF.<br>
                Taille maximale par fichier : 2 Mo.
            </p>
        </aside>
    </div>
</div>
@endsection
