@extends('layouts.proprietaire')

@section('title', 'Modifier le logement')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg border border-gray-200">
    <h2 class="text-3xl font-extrabold text-gray-900 mb-8 border-b pb-4">
        Modifier le logement
    </h2>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-400 rounded text-red-700">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('proprietaire.logements.update', $logement) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="titre">Titre <span class="text-red-500">*</span></label>
                <input id="titre" type="text" name="titre" value="{{ old('titre', $logement->titre) }}" required
                    class="w-full rounded-md border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-4 py-2 transition duration-150" />
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="adresse">Adresse <span class="text-red-500">*</span></label>
                <input id="adresse" type="text" name="adresse" value="{{ old('adresse', $logement->adresse) }}" required
                    class="w-full rounded-md border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-4 py-2 transition duration-150" />
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="type">Type <span class="text-red-500">*</span></label>
                <select id="type" name="type" required
                    class="w-full rounded-md border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-4 py-2 transition duration-150">
                    @foreach(['studio', 'appartement', 'chambre', 'colocation'] as $type)
                        <option value="{{ $type }}" @selected(old('type', $logement->type) === $type)>
                            {{ ucfirst($type) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="nombre_chambres">Nombre de chambres <span class="text-red-500">*</span></label>
                <input id="nombre_chambres" type="number" name="nombre_chambres" value="{{ old('nombre_chambres', $logement->nombre_chambres) }}" required
                    class="w-full rounded-md border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-4 py-2 transition duration-150" />
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="superficie">Superficie (m²) <span class="text-red-500">*</span></label>
                <input id="superficie" type="number" step="0.01" name="superficie" value="{{ old('superficie', $logement->superficie) }}" required
                    class="w-full rounded-md border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-4 py-2 transition duration-150" />
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="loyer">Loyer (FCFA) <span class="text-red-500">*</span></label>
                <input id="loyer" type="number" step="0.01" name="loyer" value="{{ old('loyer', $logement->loyer) }}" required
                    class="w-full rounded-md border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-4 py-2 transition duration-150" />
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="charges">Charges (FCFA)</label>
                <input id="charges" type="number" step="0.01" name="charges" value="{{ old('charges', $logement->charges) }}"
                    class="w-full rounded-md border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-4 py-2 transition duration-150" />
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2" for="disponibilite">Disponibilité <span class="text-red-500">*</span></label>
                <input id="disponibilite" type="date" name="disponibilite"
                    value="{{ old('disponibilite', \Carbon\Carbon::parse($logement->disponibilite)->format('Y-m-d')) }}" required
                    class="w-full rounded-md border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-4 py-2 transition duration-150" />
            </div>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-2" for="description">Description</label>
            <textarea id="description" name="description" rows="5"
                class="w-full rounded-md border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-4 py-3 resize-none transition duration-150">{{ old('description', $logement->description) }}</textarea>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-2" for="photos">Remplacer les photos</label>
            <input id="photos" type="file" name="photos[]" multiple accept="image/*"
                class="w-full rounded-md border border-gray-300 px-4 py-2 transition duration-150 cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500" />
            <p class="text-sm text-gray-500 mt-1">Sélectionnez de nouvelles photos pour remplacer celles existantes.</p>
        </div>

        @if($logement->photos->isNotEmpty())
            <div>
                <h4 class="text-gray-600 font-semibold mb-3">Photos actuelles :</h4>
                <div class="flex flex-wrap gap-3">
                    @foreach($logement->photos as $photo)
                        <img src="{{ asset('storage/' . $photo->chemin) }}" alt="Photo logement" class="w-28 h-28 rounded-lg object-cover shadow-md border border-gray-200" />
                    @endforeach
                </div>
            </div>
        @endif

        <div class="pt-6 border-t border-gray-200">
            <button type="submit"
                class="w-full md:w-auto bg-blue-600 text-white font-semibold px-8 py-3 rounded-lg shadow hover:bg-blue-700 transition duration-200">
                Mettre à jour
            </button>
        </div>
    </form>
</div>
@endsection
