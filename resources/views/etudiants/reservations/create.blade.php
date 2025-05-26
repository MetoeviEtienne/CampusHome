@extends('layouts.naveshow')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="max-w-6xl mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold text-center text-blue-700 mb-10">Espace de réservation de logement</h1>

    <div class="grid md:grid-cols-3 gap-6">
        <!-- Colonne principale : infos + formulaire -->
        <div class="md:col-span-2 bg-white shadow-lg rounded-2xl p-8 border border-gray-100">
            <!-- Titre du logement -->
            <h2 class="text-3xl font-bold text-gray-800 mb-6">{{ $logement->titre }}</h2>

            <!-- Infos logement -->
            <ul class="space-y-2 mb-6 text-gray-700">
                <li><strong>🏙️ Ville :</strong> {{ $logement->adresse }}</li>
                <li><strong>💰 Loyer :</strong> {{ $logement->loyer }} FCFA</li>
                <li><strong>🏠 Type :</strong> {{ $logement->type }}</li>
                <li><strong>📏 Superficie :</strong> {{ $logement->superficie }} m²</li>
                <li><strong>👤 Propriétaire :</strong> {{ $logement->proprietaire->name }}</li>
            </ul>

            <hr class="my-6 border-gray-300">

            <!-- Formulaire de réservation -->
            <h3 class="text-2xl font-semibold text-gray-700 mb-4">Réserver ce logement</h3>

            <form action="{{ route('etudiants.reservations.store', ['logement' => $logement->id]) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <div>
                    <label for="date_debut" class="block text-sm font-medium text-gray-600">📅 Date de début</label>
                    <input type="date" id="date_debut" name="date_debut" required 
                    class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label for="date_fin" class="block text-sm font-medium text-gray-600">📅 Date de fin (max 5 jours)</label>
                    <input type="date" id="date_fin" name="date_fin" required 
                    class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label for="universite" class="block text-sm font-medium text-gray-600">🎓 Université</label>
                    <select name="universite" id="universite" required class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2 bg-white"
                        onchange="toggleAutreUniversite(this.value)">
                        <option value="">-- Sélectionner votre université --</option>
                        @foreach([
                            "Université de Parakou", "Université d'Abomey-Calavi", "Université de Natitingou", "UNA",
                            "UNESTIM", "INJEPS", "Université d'Adjarra", "FSS", "Université de Kétou", "INSTI de Lokossa", "Autre"
                        ] as $uni)
                            <option value="{{ $uni }}" {{ old('universite') == $uni ? 'selected' : '' }}>{{ $uni }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="autre-universite-container" class="mt-2" style="display: {{ old('universite') === 'Autre' ? 'block' : 'none' }};">
                    <label for="autre_universite" class="block text-sm font-medium text-gray-600">Autre université</label>
                    <input type="text" name="autre_universite" id="autre_universite" value="{{ old('autre_universite') }}"
                        class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2"
                        {{ old('universite') === 'Autre' ? 'required' : '' }}>
                </div>

                <div>
                    <label for="inscription_pdf" class="block text-sm font-medium text-gray-600">📄 Justificatif d'inscription (PDF)</label>
                    <input type="file" name="inscription_pdf" accept="application/pdf" required
                        class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2 bg-white">
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-300">
                    Réserver ce logement
                </button>
            </form>
        </div>

        <!-- Colonne droite : Infos complémentaires -->
        <div class="bg-blue-50 border-l-4 border-blue-400 text-blue-800 p-4 rounded shadow h-fit">
            <h3 class="text-lg font-semibold mb-2">À savoir</h3>
            <p class="text-sm">
                La réservation est effectuée et gardée pendant <strong>5 jours au plus</strong>. 
                Au-delà de cette période, elle est <strong>automatiquement annulée</strong>.
            </p>
            <p class="text-sm mt-3">
                Veuillez impérativement importer vos pièces justificatives étudiantes (une carte et la fiche de préinscription universitaire (obligatoire)) :
            </p>
            <ul class="list-disc list-inside text-sm mt-2 space-y-1">
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
            autreContainer.style.display = 'block';
            autreInput.required = true;
        } else {
            autreContainer.style.display = 'none';
            autreInput.required = false;
            autreInput.value = '';
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const selectUniversite = document.getElementById('universite');
        toggleAutreUniversite(selectUniversite.value);
    });

    // // Empecher la reservation au dela de 5 jours
    //   const dateDebut = document.getElementById('date_debut');
    // const dateFin = document.getElementById('date_fin');

    // const today = new Date();
    // const todayStr = today.toISOString().split('T')[0];

    // // Empêcher de sélectionner une date avant aujourd'hui
    // dateDebut.min = todayStr;
    // dateFin.min = todayStr;

    // dateDebut.addEventListener('change', () => {
    //     if (!dateDebut.value) return;

    //     const debut = new Date(dateDebut.value);
    //     const finMin = new Date(debut);
    //     const finMax = new Date(debut);
    //     finMax.setDate(debut.getDate() + 5);

    //     const finMinStr = finMin.toISOString().split('T')[0];
    //     const finMaxStr = finMax.toISOString().split('T')[0];

    //     dateFin.min = finMinStr;
    //     dateFin.max = finMaxStr;

    //     // Si la date actuelle de fin est invalide, on la vide
    //     if (dateFin.value && (dateFin.value < dateFin.min || dateFin.value > dateFin.max)) {
    //         dateFin.value = '';
    //     }
    // });

    // // Initialisation au chargement
    // window.addEventListener('DOMContentLoaded', () => {
    //     dateDebut.min = todayStr;
    //     dateFin.min = todayStr;

    //     if (dateDebut.value) {
    //         dateDebut.dispatchEvent(new Event('change'));
    //     }
    // });
</script>
@endsection
