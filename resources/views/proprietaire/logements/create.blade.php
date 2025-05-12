@extends('layouts.proprietaire')

@section('title', 'Ajouter un logement')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Ajouter un nouveau logement</h2>

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

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="titre" class="block font-medium">Titre *</label>
                <input type="text" id="titre" name="titre" value="{{ old('titre') }}" required class="w-full border rounded p-2">
            </div>

            <div>
                <label for="adresse" class="block font-medium">Adresse *</label>
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
@endsection
