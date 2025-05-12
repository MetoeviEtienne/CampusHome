@extends('layouts.proprietaire')

@section('title', 'Modifier le logement')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Modifier le logement</h2>

    @if ($errors->any())
        <div class="mb-4 text-red-600">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('proprietaire.logements.update', $logement) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-medium">Titre *</label>
                <input type="text" name="titre" value="{{ old('titre', $logement->titre) }}" required class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block font-medium">Adresse *</label>
                <input type="text" name="adresse" value="{{ old('adresse', $logement->adresse) }}" required class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block font-medium">Type *</label>
                <select name="type" required class="w-full border rounded p-2">
                    @foreach(['studio', 'appartement', 'chambre', 'colocation'] as $type)
                        <option value="{{ $type }}" @selected(old('type', $logement->type) === $type)>
                            {{ ucfirst($type) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium">Nombre de chambres *</label>
                <input type="number" name="nombre_chambres" value="{{ old('nombre_chambres', $logement->nombre_chambres) }}" required class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block font-medium">Superficie (m²) *</label>
                <input type="number" step="0.01" name="superficie" value="{{ old('superficie', $logement->superficie) }}" required class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block font-medium">Loyer (FCFA) *</label>
                <input type="number" step="0.01" name="loyer" value="{{ old('loyer', $logement->loyer) }}" required class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block font-medium">Charges (FCFA)</label>
                <input type="number" step="0.01" name="charges" value="{{ old('charges', $logement->charges) }}" class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block font-medium">Disponibilité *</label>
                <input type="date" name="disponibilite" value="{{ old('disponibilite', \Carbon\Carbon::parse($logement->disponibilite)->format('Y-m-d')) }}" required class="w-full border rounded p-2">

            </div>
        </div>

        <div class="mt-4">
            <label class="block font-medium">Description</label>
            <textarea name="description" rows="4" class="w-full border rounded p-2">{{ old('description', $logement->description) }}</textarea>
        </div>

        <div class="mt-4">
            <label class="block font-medium">Remplacer les photos</label>
            <input type="file" name="photos[]" multiple accept="image/*" class="w-full">
            <p class="text-sm text-gray-500 mt-1">Sélectionnez de nouvelles photos pour remplacer celles existantes.</p>
        </div>

        @if($logement->photos->isNotEmpty())
            <div class="mt-4">
                <h4 class="text-sm font-semibold text-gray-600 mb-2">Photos actuelles :</h4>
                <div class="flex gap-2">
                    @foreach($logement->photos as $photo)
                        <img src="{{ asset('storage/' . $photo->chemin) }}" class="w-24 h-24 object-cover rounded">
                    @endforeach
                </div>
            </div>
        @endif

        <div class="mt-6">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Mettre à jour
            </button>
        </div>
    </form>
</div>
@endsection
