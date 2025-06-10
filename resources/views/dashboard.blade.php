@extends('layouts.etudiant')

@section('title', 'Logements disponibles')

@section('content')
{{-- Lightbox2 CSS --}}
<link href="https://cdn.jsdelivr.net/npm/lightbox2@2/dist/css/lightbox.min.css" rel="stylesheet">

<div class="max-w-7xl mx-auto py-10 px-4">
    {{-- Titre --}}
    {{-- <h1 class="text-3xl font-bold text-gray-800 mb-8">Logements disponibles</h1> --}}

    {{-- Grille des logements --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        @forelse($logements as $logement)
            <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden flex flex-col max-w-md w-full mx-auto">
                {{-- Image principale + galerie --}}
                @if($logement->photos->isNotEmpty())
                    <div class="relative group">
                        {{-- Image principale cliquable --}}
                        <a href="{{ asset('storage/' . $logement->photos->first()->chemin) }}" data-lightbox="logement-{{ $logement->id }}" data-title="{{ $logement->adresse }}">
                            <img src="{{ asset('storage/' . $logement->photos->first()->chemin) }}"
                                 alt="Photo principale"
                                 class="w-full h-52 object-cover group-hover:brightness-75 transition duration-300" />
                        </a>

                        {{-- Miniatures affichées au survol --}}
                        @if($logement->photos->count() > 1)
                            <div class="absolute inset-0 bg-black bg-opacity-60 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center gap-2 flex-wrap p-2">
                                @foreach($logement->photos->slice(1, 3) as $photo)
                                    <a href="{{ asset('storage/' . $photo->chemin) }}" data-lightbox="logement-{{ $logement->id }}">
                                        <img src="{{ asset('storage/' . $photo->chemin) }}" class="h-16 w-16 object-cover rounded" alt="Mini photo">
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @else
                    <div class="h-52 bg-gray-200 flex items-center justify-center text-gray-500">
                        Aucune image disponible
                    </div>
                @endif
                
                {{-- Détails du logement --}}
                <div class="p-5 flex flex-col flex-grow">
                    <h2 class="text-xl font-semibold text-gray-800">{{ $logement->adresse }}</h2>
                    <h2 class="text-xl font-semibold text-gray-800">{{ $logement->quartier }}</h2>
                    <p class="text-sm text-gray-500 mb-1">{{ ucfirst($logement->type) }} • {{ $logement->superficie }} m²</p>
                    <p class="text-lg font-bold text-blue-600">{{ number_format($logement->loyer, 0, ',', ' ') }} FCFA/mois</p>

                    @if ($logement->estDejaReserve ?? false)
                        <span class="mt-2 inline-block text-sm text-red-600 font-semibold">Déjà réservé</span>
                    @endif

                  {{-- Étoiles de notation interactives --}}
                    <div class="mt-4 relative flex gap-1 text-gray-300 etoiles-notes" data-logement="{{ $logement->id }}">
                        @for ($i = 1; $i <= 5; $i++)
                           <span class="etoile text-2xl cursor-pointer" data-note="{{ $i }}">&#9733;</span>
                        @endfor
                    </div>

                   {{-- @php
                        $total = $logement->avisEtoiles->sum('note');
                        $count = $logement->avisEtoiles->count();
                        $noteMoyenne = $count > 0 ? $total / $count : 0;
                    @endphp

                    <p class="text-sm text-gray-600 mt-2" id="note-moyenne-text">
                        Note moyenne : {{ number_format($noteMoyenne, 1) }}/5 ({{ $count }} votes)
                    </p> --}}



                    <div class="mt-auto pt-4 flex flex-wrap gap-2">
                        <a href="{{ route('etudiant.logements.show', $logement) }}"
                           class="px-4 py-2 text-sm bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Voir détails</a>
                        <a href="{{ route('etudiant.logements.avis', $logement->id) }}"
                           class="px-4 py-2 text-sm bg-gray-600 text-white rounded-md hover:bg-gray-700 transition">Donner un avis</a>
                        <a href="{{ route('etudiants.messages.conversation', ['proprietaireId' => $logement->proprietaire_id]) }}"
                           class="px-4 py-2 text-sm bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition">Discuter</a>
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
<footer class="bg-blue-600 text-white mt-16">
    <div class="max-w-7xl mx-auto px-6 py-10 grid grid-cols-1 sm:grid-cols-3 gap-8">
        <!-- À propos -->
        <div>
            <h3 class="text-xl font-bold mb-4">CampusHome</h3>
            <p class="text-sm opacity-80">
                Votre plateforme pour gérer facilement vos logements et réservations.  
                Simple, rapide, et sécurisée.
            </p>
        </div>

        <!-- Liens rapides -->
        <div>
            <h4 class="text-lg font-semibold mb-4">Liens rapides</h4>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ route('dashboard') }}" class="hover:underline hover:text-gray-200">Accueil</a></li>
                {{-- <li><a href="{{ route('etudiant.logements.index') }}" class="hover:underline hover:text-gray-200">Logements</a></li> --}}
                <li><a href="{{ route('etudiant.reservations.index') }}" class="hover:underline hover:text-gray-200">Mes réservations</a></li>
                 <li><a href="{{ route('colocations.index') }}" class="hover:underline hover:text-gray-200"> Voir annonce ({{ $nbAnnonces }})</a></li> 
                <li>
                    <a href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); document.getElementById('logout-form-footer').submit();" 
                       class="hover:underline hover:text-gray-200 cursor-pointer">Déconnexion</a>
                    <form id="logout-form-footer" method="POST" action="{{ route('logout') }}" class="hidden">@csrf</form>
                </li>
            </ul>
        </div>

        <!-- Contact -->
        <div>
            <h4 class="text-lg font-semibold mb-4">Contactez-nous</h4>
            <p class="text-sm opacity-80">Abtasi<br>Cotonou, Bénin</p>
            <p class="mt-2 text-sm opacity-80">Email : contactabtsi@gmail.com</p>
            <p class="mt-1 text-sm opacity-80">Téléphone : +229 00 00 00 00</p>
        </div>
    </div>

    <div class="border-t border-blue-500 mt-8 py-4 text-center text-sm opacity-70">
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
            etoile.addEventListener('mouseenter', function () {
                const note = this.dataset.note;
                highlightStars(note);
            });

            etoile.addEventListener('mouseleave', function () {
                highlightStars(currentNote);
            });

            etoile.addEventListener('click', function () {
                const note = this.dataset.note;
                currentNote = note;
                highlightStars(note);
                envoyerNote(note, logementId, bloc);
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
