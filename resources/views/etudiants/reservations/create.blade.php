@extends('layouts.naveshow')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10">
    @if(session('success'))
        <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-800 p-4 rounded mb-6 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-800 p-4 rounded mb-6 shadow-sm">
            {{ session('error') }}
        </div>
    @endif

    <h1 class="text-4xl font-extrabold text-center text-blue-800 mb-12">🏡 Réservation de logement étudiant</h1>

    <div class="grid md:grid-cols-3 gap-8">
        <!-- Infos + Formulaire -->
        <div class="md:col-span-2 bg-white border border-gray-200 rounded-2xl shadow-lg p-8">
            <h2 class="text-3xl font-semibold text-gray-900 mb-4">{{ $logement->titre }}</h2>

            <ul class="text-gray-700 space-y-2 mb-8">
                <li><strong>📍 Adresse :</strong> {{ $logement->adresse }}</li>
                <li><strong>💸 Loyer :</strong> <span class="text-blue-700 font-semibold">{{ $logement->loyer }} FCFA</span></li>
                <li><strong>🏠 Type :</strong> {{ $logement->type }}</li>
                <li><strong>📐 Superficie :</strong> {{ $logement->superficie }} m²</li>
                <li><strong>👤 Propriétaire :</strong> {{ $logement->proprietaire->name }}</li>
            </ul>

            <hr class="my-6">

            <h3 class="text-2xl font-semibold text-gray-800 mb-6">📝 Réserver maintenant</h3>

            <form action="{{ route('etudiants.reservations.store', ['logement' => $logement->id]) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label for="date_debut" class="block text-sm font-medium text-gray-600 mb-1">📅 Date de début</label>
                    <input type="date" id="date_debut" name="date_debut" required
                        class="w-full border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm">
                </div>

                <div>
                    <label for="date_fin" class="block text-sm font-medium text-gray-600 mb-1">📅 Date de fin (max 5 jours)</label>
                    <input type="date" id="date_fin" name="date_fin" required
                        class="w-full border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none shadow-sm">
                </div>

                <div>
                    <label for="universite" class="block text-sm font-medium text-gray-600 mb-1">🎓 Université</label>
                    <select name="universite" id="universite" required
                        class="w-full border-gray-300 rounded-xl px-4 py-2 bg-white shadow-sm"
                        onchange="toggleAutreUniversite(this.value)">
                        <option value="">-- Choisissez votre université --</option>
                        @foreach([
                            "Université de Parakou", "Université d'Abomey-Calavi", "Université de Natitingou", "UNA",
                            "UNESTIM", "INJEPS", "Université d'Adjarra", "FSS", "Université de Kétou", "INSTI de Lokossa", "Autre"
                        ] as $uni)
                            <option value="{{ $uni }}" {{ old('universite') == $uni ? 'selected' : '' }}>{{ $uni }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="autre-universite-container" class="mt-2 hidden">
                    <label for="autre_universite" class="block text-sm font-medium text-gray-600 mb-1">🏫 Autre université</label>
                    <input type="text" name="autre_universite" id="autre_universite" value="{{ old('autre_universite') }}"
                        class="w-full border-gray-300 rounded-xl px-4 py-2 shadow-sm">
                </div>

                <div>
                    <label for="inscription_pdf" class="block text-sm font-medium text-gray-600 mb-1">📄 Justificatif d'inscription (PDF)</label>
                    <input type="file" name="inscription_pdf" accept="application/pdf" required
                        class="w-full border-gray-300 rounded-xl px-4 py-2 bg-white shadow-sm">
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-xl transition duration-300 shadow-md">
                    📌 Réserver maintenant
                </button>
            </form>
        </div>

        <!-- Infos utiles -->
        <div class="bg-blue-100 border border-blue-300 rounded-2xl p-6 shadow-md">
            <h3 class="text-xl font-semibold text-blue-900 mb-3">ℹ️ À savoir</h3>
            <p class="text-sm text-blue-800 mb-3">
                La réservation est valable <strong>5 jours</strong> maximum. Passé ce délai, elle est <strong>annulée automatiquement</strong>.
            </p>
            <p class="text-sm text-blue-800 mb-2">Documents obligatoires :</p>
            <ul class="list-disc pl-5 text-sm text-blue-800 space-y-1">
                <li>Carte CIP</li>
                <li>Carte CIN</li>
                <li>Carte biométrique valide</li>
                <li>Fiche de préinscription universitaire</li>
            </ul>
        </div>
    </div>
</div>

<script>
    function toggleAutreUniversite(value) {
        const autreContainer = document.getElementById('autre-universite-container');
        const autreInput = document.getElementById('autre_universite');
        if (value === 'Autre') {
            autreContainer.classList.remove('hidden');
            autreInput.required = true;
        } else {
            autreContainer.classList.add('hidden');
            autreInput.required = false;
            autreInput.value = '';
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const universiteSelect = document.getElementById('universite');
        toggleAutreUniversite(universiteSelect.value);
    });
</script>
@endsection
