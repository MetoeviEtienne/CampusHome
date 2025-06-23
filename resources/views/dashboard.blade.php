@extends('layouts.etudiant')

@section('title', 'Logements disponibles')

@section('content')
{{-- Lightbox2 CSS --}}
<link href="https://cdn.jsdelivr.net/npm/lightbox2@2/dist/css/lightbox.min.css" rel="stylesheet">

<div class="max-w-7xl mx-auto py-10 px-4">
    {{-- Grille des logements --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
        @forelse($logements as $logement)
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition duration-300 overflow-hidden flex flex-col w-full mx-auto max-w-[600px] lg:max-w-[600px]">

                {{-- Image principale + galerie --}}
                @if($logement->photos->isNotEmpty())
                    <div class="relative group">
                        <a href="{{ asset('storage/' . $logement->photos->first()->chemin) }}"
                           data-lightbox="logement-{{ $logement->id }}"
                           data-title="{{ $logement->adresse }}">
                            <img src="{{ asset('storage/' . $logement->photos->first()->chemin) }}"
                                 alt="Photo principale"
                                 class="w-full h-60 object-cover group-hover:brightness-75 transition duration-300" />
                        </a>

                        @if($logement->photos->count() > 1)
                            <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center gap-2 flex-wrap p-2">
                                @foreach($logement->photos->slice(1, 3) as $photo)
                                    <a href="{{ asset('storage/' . $photo->chemin) }}" data-lightbox="logement-{{ $logement->id }}">
                                        <img src="{{ asset('storage/' . $photo->chemin) }}"
                                             class="h-16 w-16 object-cover rounded" alt="Mini photo">
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @else
                    <div class="h-60 bg-gray-200 flex items-center justify-center text-gray-500">
                        Aucune image disponible
                    </div>
                @endif

                {{-- Détails --}}
                <div class="p-6 flex flex-col flex-grow">
                    <h2 class="text-xl font-bold text-gray-800 mb-1">{{ $logement->adresse }}</h2>
                    <h3 class="text-md font-medium text-gray-600 mb-1">{{ $logement->quartier }}</h3>
                    <p class="text-sm text-gray-500">{{ ucfirst($logement->type) }} • {{ $logement->superficie }} m²</p>
                    <p class="text-lg font-bold text-indigo-600 mt-2">{{ number_format($logement->loyer, 0, ',', ' ') }} FCFA/mois</p>

                    @if ($logement->estDejaReserve ?? false)
                        <span class="mt-2 inline-block text-sm text-red-600 font-semibold">Déjà réservé</span>
                    @endif

                    {{-- Étoiles --}}
                    <div class="mt-4 flex gap-1 text-gray-300 etoiles-notes" data-logement="{{ $logement->id }}">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="etoile text-2xl cursor-pointer" data-note="{{ $i }}">&#9733;</span>
                        @endfor
                    </div>

                    {{-- Actions --}}
                    <div class="mt-auto pt-5 flex flex-nowrap gap-2 overflow-visible">
                        <a href="{{ route('etudiant.logements.show', $logement) }}"
                           class="flex-1 inline-flex items-center justify-center gap-2 px-2 py-2 text-sm bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
                            👁 Voir détails
                        </a>
                        <a href="{{ route('etudiant.logements.avis', $logement->id) }}"
                           class="flex-1 inline-flex items-center justify-center gap-1 px-2 py-2 text-sm border border-gray-400 text-gray-700 rounded-md hover:bg-gray-100 transition">
                            ⭐ Donner un avis
                        </a>
                        <a href="{{ route('etudiants.messages.conversation', ['proprietaireId' => $logement->proprietaire_id]) }}"
                           class="flex-1 inline-flex items-center justify-center gap-1 px-2 py-2 text-sm border border-yellow-400 text-yellow-600 rounded-md hover:bg-yellow-50 transition">
                            💬 Discuter
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-500 col-span-full">Aucun logement disponible pour le moment.</p>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-10">
        {{ $logements->links() }}
    </div>
</div>

{{-- Footer --}}
<footer class="bg-indigo-700 text-white mt-16">
    <div class="max-w-7xl mx-auto px-6 py-10 grid grid-cols-1 sm:grid-cols-3 gap-8">
        <div>
            <h3 class="text-xl font-bold mb-4">CampusHome</h3>
            <p class="text-sm opacity-80">
                Plateforme moderne de gestion de logements étudiants. Simple, rapide et sécurisée.
            </p>
        </div>
        <div>
            <h4 class="text-lg font-semibold mb-4">Liens utiles</h4>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ route('dashboard') }}" class="hover:underline hover:text-gray-200">Accueil</a></li>
                <li><a href="{{ route('etudiant.reservations.index') }}" class="hover:underline hover:text-gray-200">Mes réservations</a></li>
                <li><a href="{{ route('colocations.index') }}" class="hover:underline hover:text-gray-200">Voir annonces ({{ $nbAnnonces }})</a></li>
                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form-footer').submit();"
                       class="hover:underline hover:text-gray-200">Déconnexion</a>
                    <form id="logout-form-footer" method="POST" action="{{ route('logout') }}" class="hidden">@csrf</form>
                </li>
            </ul>
        </div>
        <div>
            <h4 class="text-lg font-semibold mb-4">Contact</h4>
            <p class="text-sm opacity-80">Abtasi, Cotonou</p>
            <p class="text-sm opacity-80 mt-1">Email : contactabtsi@gmail.com</p>
            <p class="text-sm opacity-80 mt-1">Téléphone : +229 00 00 00 00</p>
        </div>
    </div>
    <div class="border-t border-indigo-600 mt-8 py-4 text-center text-sm opacity-70">
        &copy; {{ date('Y') }} CampusHome. Tous droits réservés.
    </div>
</footer>

{{-- Lightbox2 JS --}}
<script src="https://cdn.jsdelivr.net/npm/lightbox2@2/dist/js/lightbox.min.js"></script>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function () {
    const blocsEtoiles = document.querySelectorAll('.etoiles-notes');

    blocsEtoiles.forEach(bloc => {
        const logementId = bloc.dataset.logement;
        let currentNote = 0;
        const etoiles = bloc.querySelectorAll('.etoile');

        etoiles.forEach(etoile => {
            etoile.addEventListener('mouseenter', () => highlightStars(etoile.dataset.note));
            etoile.addEventListener('mouseleave', () => highlightStars(currentNote));
            etoile.addEventListener('click', () => {
                currentNote = etoile.dataset.note;
                highlightStars(currentNote);
                envoyerNote(currentNote, logementId, bloc);
            });
        });

        function highlightStars(note) {
            etoiles.forEach(etoile => {
                etoile.classList.toggle('text-yellow-400', etoile.dataset.note <= note);
            });
        }

        function envoyerNote(note, logementId, bloc) {
            fetch(`/etudiant/logements/${logementId}/noter`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ note: note })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success && data.note_moyenne) {
                    const noteMoyenneText = bloc.parentElement.querySelector('#note-moyenne-text');
                    if (noteMoyenneText) {
                        noteMoyenneText.textContent = `Note moyenne : ${data.note_moyenne}/5 (${data.total} votes)`;
                    }
                }
            });
        }
    });
});
</script>
