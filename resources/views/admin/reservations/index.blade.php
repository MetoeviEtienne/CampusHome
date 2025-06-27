@extends('layouts.admin')

@section('title', 'Réservations')

@section('content')
<h2 class="text-3xl font-semibold mb-8 text-gray-800 text-center">Demandes de réservation</h2>

@if(session('success'))
    <div class="max-w-xl mx-auto mb-6 p-4 bg-green-100 border border-green-300 rounded-lg text-green-800 text-center font-semibold">
        {{ session('success') }}
    </div>
@endif

@if ($reservationsParProprietaire->isEmpty())
    <p class="text-center text-gray-500 italic text-lg">Aucune réservation pour l'instant.</p>
@else
    <div class="space-y-12">
        @foreach ($reservationsParProprietaire as $proprietaireName => $reservations)
            <div>
                <h3 class="text-2xl font-bold mb-6 text-blue-700 border-b border-blue-300 pb-2">Propriétaire : {{ $proprietaireName }}</h3>

                <div class="space-y-8">
                    @foreach ($reservations as $reservation)
                        @php
                            $avancePaiement = $reservation->paiements
                                ->where('type', 'avance')
                                ->where('statut', 'payé')
                                ->sortByDesc('created_at')
                                ->first();

                            $loyerPaiement = $reservation->paiements
                                ->where('type', 'loyer')
                                ->where('statut', 'payé')
                                ->sortByDesc('created_at')
                                ->first();

                            $photo = $reservation->logement->photos->first();
                        @endphp

                        <div class="bg-white rounded-xl shadow-lg p-6 flex flex-col md:flex-row justify-between hover:shadow-2xl transition-shadow duration-300">
                            {{-- Photo logement --}}
                            <div class="w-full md:w-48 h-40 md:h-48 flex-shrink-0 rounded-lg overflow-hidden shadow-md mb-5 md:mb-0">
                                @if($photo)
                                    <img src="{{ asset('storage/' . $photo->chemin) }}" alt="Photo logement" class="w-full h-full object-cover" loading="lazy" />
                                @else
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400 text-sm">
                                        Pas de photo
                                    </div>
                                @endif
                            </div>

                            {{-- Infos principales --}}
                            <div class="flex-1 max-w-xl space-y-4 md:ml-6">
                                {{-- Paiements --}}
                                @if($avancePaiement)
                                    <div class="bg-green-100 text-green-800 p-3 rounded-lg font-semibold text-sm shadow-inner">
                                        L'avance a été payée ✅<br>
                                        <small>Paiement le {{ $avancePaiement->created_at->format('d/m/Y H:i') }}</small>
                                    </div>
                                @endif

                                @if($loyerPaiement)
                                    <div class="bg-blue-100 text-blue-800 p-3 rounded-lg font-semibold text-sm shadow-inner">
                                        Le loyer a été payé ✅<br>
                                        <small>Paiement le {{ $loyerPaiement->created_at->format('d/m/Y H:i') }}</small>
                                    </div>
                                @endif

                                <p class="text-lg font-semibold text-gray-900">
                                    <strong>{{ $reservation->etudiant->name }}</strong> a réservé <strong>{{ $reservation->logement->titre }}</strong>
                                </p>

                                <p class="text-gray-600 text-sm">
                                    Pour le <time datetime="{{ $reservation->date_debut }}">{{ \Carbon\Carbon::parse($reservation->date_debut)->format('d/m/Y') }}</time>
                                </p>

                                <p class="text-gray-700 text-sm">Université : <strong>{{ $reservation->universite }}</strong></p>

                                {{-- Visite --}}
                                @if ($reservation->visite_date)
                                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-3 text-yellow-800 rounded-md flex items-center gap-2 font-medium text-sm">
                                        <i class="fas fa-calendar-check text-yellow-500"></i>
                                        Date de visite <strong>{{ \Carbon\Carbon::parse($reservation->visite_date)->format('d/m/Y') }}</strong>
                                        @if ($reservation->visite_heure)
                                            à <strong>{{ \Carbon\Carbon::parse($reservation->visite_heure)->format('H:i') }}</strong>
                                        @endif
                                    </div>
                                @endif

                                {{-- Inscription PDF --}}
                                <p class="text-sm text-gray-700">
                                    Inscription PDF :
                                    @if ($reservation->inscription_pdf)
                                        <a href="{{ asset('storage/' . $reservation->inscription_pdf) }}" target="_blank"
                                           class="text-indigo-600 underline hover:text-indigo-800 transition-colors font-medium">
                                            Voir le document
                                        </a>
                                    @else
                                        <span class="italic text-gray-400">Aucun document</span>
                                    @endif
                                </p>

                                {{-- Statut --}}
                                <p class="text-sm mt-1">
                                    Statut :
                                    <span class="font-semibold
                                        {{ $reservation->statut === 'approuvee' ? 'text-green-700' : '' }}
                                        {{ $reservation->statut === 'rejetee' ? 'text-red-700' : '' }}
                                        {{ $reservation->statut === 'en_attente' ? 'text-yellow-600' : '' }}">
                                        {{ ucfirst($reservation->statut) }}
                                    </span>
                                </p>
                            </div>

                            {{-- Actions --}}
                            <div class="flex flex-col gap-3 items-end mt-6 md:mt-0 whitespace-nowrap min-w-[140px]">
                                @if ($reservation->statut === 'en_attente')
                                    <form method="POST" action="{{ route('admin.reservations.approve', $reservation) }}" class="w-full">
                                        @csrf
                                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-full font-semibold shadow-md transition duration-300">
                                            Approuver
                                        </button>
                                    </form>

                                    <form method="POST" action="{{ route('admin.reservations.reject', $reservation) }}" class="w-full">
                                        @csrf
                                        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-full font-semibold shadow-md transition duration-300">
                                            Rejeter
                                        </button>
                                    </form>
                                @endif

                                <form method="POST" action="{{ route('admin.reservations.destroy', $reservation) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?');" class="w-full">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full bg-gray-700 hover:bg-gray-900 text-white px-4 py-2 rounded-full font-semibold shadow-md transition duration-300">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-10">
        {{ $paginateLinks ?? '' }}
    </div>
@endif
@endsection





{{-- @extends('layouts.admin')

@section('title', 'Réservations') --}}

{{-- @section('content')
<h2 class="text-2xl font-semibold mb-6 text-gray-800">Toutes les demandes de réservation</h2> --}}

{{-- @if ($reservationsParProprietaire->isEmpty())
    <p class="text-gray-500 italic">Aucune réservation pour l’instant.</p>
@else
    <div class="space-y-8">
        @foreach ($reservationsParProprietaire as $proprietaire => $reservations)
            <div>
                <h3 class="text-xl font-bold mb-4 text-gray-700">Propriétaire : {{ $proprietaire }}</h3>
                <div class="space-y-5">
                    @foreach ($reservations as $reservation)
                        @php
                            $avancePayee = $reservation->paiements->where('type', 'avance')->where('statut', 'payé')->isNotEmpty();
                            $loyerPaye = $reservation->paiements->where('type', 'loyer')->where('statut', 'payé')->isNotEmpty();
                        @endphp --}}

                        {{-- <div class="bg-white p-5 rounded-lg shadow-md flex flex-col space-y-3 hover:shadow-lg transition-shadow duration-300">
                            @php
                            $avancePaiement = $reservation->paiements
                                ->where('type', 'avance')
                                ->where('statut', 'payé')
                                ->sortByDesc('created_at')
                                ->first();

                            $loyerPaiement = $reservation->paiements
                                ->where('type', 'loyer')
                                ->where('statut', 'payé')
                                ->sortByDesc('created_at')
                                ->first();
                             @endphp --}}

                            {{-- Notifications paiement --}}
                            {{-- @if($avancePaiement)
                                <div class="bg-green-100 text-green-800 p-2 rounded font-semibold text-sm">
                                    L'avance a été payée ✅<br>
                                    <small>Paiement le {{ \Carbon\Carbon::parse($avancePaiement->created_at)->format('d/m/Y H:i') }}</small>
                                </div>
                            @endif

                            @if($loyerPaiement)
                                <div class="bg-blue-100 text-blue-800 p-2 rounded font-semibold text-sm">
                                    Le loyer a été payé ✅<br>
                                    <small>Paiement le {{ \Carbon\Carbon::parse($loyerPaiement->created_at)->format('d/m/Y H:i') }}</small>
                                </div>
                            @endif

                            <div class="flex justify-between items-center">
                                <div class="space-y-1 max-w-xl">
                                    <p class="text-lg font-medium text-gray-900">
                                        <strong>{{ $reservation->etudiant->name }}</strong> a réservé <strong>{{ $reservation->logement->titre }}</strong>
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        Pour le <time datetime="{{ $reservation->date_debut }}">{{ \Carbon\Carbon::parse($reservation->date_debut)->format('d/m/Y') }}</time>
                                    </p>
                                    <p class="text-sm text-gray-700">Université : <strong>{{ $reservation->universite }}</strong></p>
                                    <p class="text-sm text-gray-700">
                                        Inscription PDF : 
                                        @if ($reservation->inscription_pdf)
                                            <a href="{{ asset('storage/' . $reservation->inscription_pdf) }}" target="_blank" 
                                               class="text-indigo-600 underline hover:text-indigo-800 transition-colors">
                                                Voir le document
                                            </a>
                                        @else
                                            <span class="italic text-gray-400">Aucun document</span>
                                        @endif
                                    </p> --}}
                                    {{-- <p class="text-sm mt-1">
                                        Statut : 
                                        <span class="font-semibold 
                                            {{ $reservation->statut === 'approuvee' ? 'text-green-700' : '' }}
                                            {{ $reservation->statut === 'rejetee' ? 'text-red-700' : '' }}
                                            {{ $reservation->statut === 'en_attente' ? 'text-yellow-600' : '' }}">
                                            {{ ucfirst($reservation->statut) }}
                                        </span>
                                    </p>
                                </div>

                                <div class="flex gap-3 items-center whitespace-nowrap">
                                    @if ($reservation->statut === 'en_attente')
                                        <form method="POST" action="{{ route('admin.reservations.approve', $reservation) }}">
                                            @csrf
                                            <button type="submit" 
                                                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md font-semibold shadow-sm transition">
                                                Approuver
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.reservations.reject', $reservation) }}">
                                            @csrf
                                            <button type="submit" 
                                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md font-semibold shadow-sm transition">
                                                Rejeter
                                            </button>
                                        </form>
                                    @endif

                                    <form method="POST" action="{{ route('admin.reservations.destroy', $reservation) }}" 
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-gray-700 hover:bg-gray-900 text-white px-4 py-2 rounded-md font-semibold shadow-sm transition">
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection --}}
