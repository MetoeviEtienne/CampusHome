@extends('layouts.admin')

@section('title', 'Statistiques')

@section('content')
<style>
    /* Ajustement responsive taille texte des cartes */
    @media (max-width: 640px) {
        .stats-card h2 {
            font-size: 1.5rem; /* 24px */
        }
        .stats-card p {
            font-size: 0.9rem; /* 14.4px */
        }
        .canvas-wrapper canvas {
            height: 260px !important;
        }
    }

    @media (min-width: 641px) and (max-width: 1024px) {
        .canvas-wrapper canvas {
            height: 320px !important;
        }
    }

    @media (min-width: 1025px) {
        .canvas-wrapper canvas {
            height: 400px !important;
        }
    }
</style>

<div class="w-full max-w-screen-xl mx-auto p-4 sm:p-6 md:p-8 bg-white/80 backdrop-blur-md border-l-8 border-blue-600 text-blue-900 shadow-xl rounded-xl hover:shadow-2xl transition-shadow duration-300">

    <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-gray-900 mb-10 tracking-tight text-center">
        Statistiques
    </h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
        {{-- Cartes statistiques --}}
        @foreach ([
            ['value' => $nbLogementsTotal, 'label' => 'Logements total', 'bg' => 'bg-blue-50', 'border' => 'border-blue-600', 'text' => 'text-blue-900'],
            ['value' => $nbChambresPubliees, 'label' => 'Chambres publiées', 'bg' => 'bg-green-50', 'border' => 'border-green-600', 'text' => 'text-green-900'],
            ['value' => $nbEntreesCoucheesPubliees, 'label' => 'Entrées couchées publiées', 'bg' => 'bg-indigo-50', 'border' => 'border-indigo-600', 'text' => 'text-indigo-900'],
            ['value' => $nbLogementsLoue, 'label' => 'Logements loués (payés)', 'bg' => 'bg-purple-50', 'border' => 'border-purple-600', 'text' => 'text-purple-900'],
            ['value' => $nbLogementsReserve, 'label' => 'Logements réservés (non payés)', 'bg' => 'bg-yellow-50', 'border' => 'border-yellow-600', 'text' => 'text-yellow-900'],
            ['value' => $nbChambresLoueOuReserve, 'label' => 'Chambres louées/réservées', 'bg' => 'bg-red-50', 'border' => 'border-red-600', 'text' => 'text-red-900'],
            ['value' => $nbEntreesCoucheesLoueOuReserve, 'label' => 'Entrées couchées louées/réservées', 'bg' => 'bg-pink-50', 'border' => 'border-pink-600', 'text' => 'text-pink-900'],
            ['value' => $nbUtilisateurs, 'label' => 'Utilisateurs inscrits', 'bg' => 'bg-gray-50', 'border' => 'border-gray-600', 'text' => 'text-gray-900'],
            ['value' => $nbProprietaires, 'label' => 'Propriétaires', 'bg' => 'bg-cyan-50', 'border' => 'border-cyan-600', 'text' => 'text-cyan-900'],
            ['value' => $nbEtudiants, 'label' => 'Étudiants', 'bg' => 'bg-teal-50', 'border' => 'border-teal-600', 'text' => 'text-teal-900'],
        ] as $item)
        <div class="stats-card w-full flex flex-col justify-center items-center p-5 sm:p-6 {{ $item['bg'] }} border-l-8 {{ $item['border'] }} {{ $item['text'] }} shadow-lg rounded-xl hover:shadow-2xl transition-shadow duration-300">
            <h2 class="text-2xl sm:text-3xl font-extrabold">{{ $item['value'] }}</h2>
            <p class="mt-2 text-sm sm:text-base font-semibold tracking-wide uppercase text-center">{{ $item['label'] }}</p>
        </div>
        @endforeach
    </div>

    {{-- Section Statistiques Graphiques --}}
    <section class="mt-16 space-y-16">

        {{-- Graphiques verticaux --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            @foreach ([
                ['id' => 'logementsChart', 'title' => '📈 Visualisation des statistiques'],
                ['id' => 'reservationsParMoisChart', 'title' => '📆 Répartition des réservations par mois (Année en cours)'],
                ['id' => 'montantEncaisseParMoisChart', 'title' => '💸 Montant total encaissé par mois (Année en cours)'],
            ] as $chart)
            <div class="bg-white/70 backdrop-blur-sm rounded-xl shadow-md p-4 sm:p-6 flex flex-col w-full">
                <h2 class="text-base sm:text-lg font-semibold mb-4 text-gray-800">{{ $chart['title'] }}</h2>
                <div class="canvas-wrapper flex-grow">
                    <canvas id="{{ $chart['id'] }}" class="w-full"></canvas>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Graphiques circulaires --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach ([
                ['id' => 'utilisateursChart', 'title' => '🧑‍🎓 Répartition des utilisateurs'],
                ['id' => 'paiementsChart', 'title' => '💳 Répartition des paiements'],
                ['id' => 'montantsChart', 'title' => '💰 Répartition du montant encaissé'],
            ] as $chart)
            <div class="bg-white rounded-xl shadow-md p-4 sm:p-6 flex flex-col items-center w-full max-w-xs mx-auto">
                <h2 class="text-sm sm:text-base font-semibold mb-4 text-gray-800 text-center">{{ $chart['title'] }}</h2>
                <canvas id="{{ $chart['id'] }}" class="w-full max-w-[220px] h-auto"></canvas>
            </div>
            @endforeach
        </div>
    </section>
</div>

{{-- Scripts ChartJS --}}
<script>
    const moisLabels = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'];

    // Logements Chart
    new Chart(document.getElementById('logementsChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: ['Logements totaux', 'Loués', 'Réservés', 'Chambres publiées', 'Entrées couchées publiées'],
            datasets: [{
                label: 'Nombre',
                data: [
                    {{ $nbLogementsTotal }},
                    {{ $nbLogementsLoue }},
                    {{ $nbLogementsReserve }},
                    {{ $nbChambresPubliees }},
                    {{ $nbEntreesCoucheesPubliees }}
                ],
                backgroundColor: ['#3B82F6', '#8B5CF6', '#FACC15', '#22C55E', '#6366F1'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { precision: 0 } }
            }
        }
    });

    // Utilisateurs Chart
    new Chart(document.getElementById('utilisateursChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: ['Étudiants', 'Propriétaires'],
            datasets: [{
                label: 'Utilisateurs',
                data: [{{ $nbEtudiants }}, {{ $nbProprietaires }}],
                backgroundColor: ['#0EA5E9', '#F43F5E'],
                borderWidth: 1
            }]
        },
        options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
    });

    // Paiements Chart
    new Chart(document.getElementById('paiementsChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: ['Avance', 'Mensuel'],
            datasets: [{
                label: 'Paiements',
                data: [{{ $nbPaiementsAvance }}, {{ $nbPaiementsMensuel }}],
                backgroundColor: ['#10B981', '#FBBF24'],
                borderWidth: 1
            }]
        },
        options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
    });

    // Réservations par mois
    new Chart(document.getElementById('reservationsParMoisChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: moisLabels,
            datasets: [{
                label: 'Réservations',
                data: @json($reservationsData),
                backgroundColor: '#3B82F6',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: { y: { beginAtZero: true, precision: 0 } }
        }
    });

    // Montant encaissé par mois
    new Chart(document.getElementById('montantEncaisseParMoisChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: moisLabels,
            datasets: [{
                label: 'Montant encaissé (XOF)',
                data: @json($paiementsData),
                fill: false,
                borderColor: '#10B981',
                tension: 0.3,
                borderWidth: 2,
                pointRadius: 4,
                pointBackgroundColor: '#10B981'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { callback: v => v.toLocaleString() }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: ctx => ctx.dataset.label + ': ' + ctx.parsed.y.toLocaleString() + ' XOF'
                    }
                }
            }
        }
    });

    // Répartition montants encaissés
    new Chart(document.getElementById('montantsChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: ['Taxes plateforme (15%)', 'Montant reversé propriétaires'],
            datasets: [{
                label: 'Montants (FCFA)',
                data: [{{ $montantTotalTaxes }}, {{ $montantReverséProprietaires }}],
                backgroundColor: ['#F87171', '#34D399'],
                borderWidth: 1
            }]
        },
        options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
    });
</script>
@endsection
