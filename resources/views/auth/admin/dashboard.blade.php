<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Admin | CampusHome</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#3B82F6',
            secondary: '#10B981',
            accent: '#6366F1',
          },
        },
      },
    }
  </script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-gray-100">

  <!-- Navbar -->
  <nav class="bg-white shadow-md px-6 py-4 flex items-center justify-between sticky top-0 z-50">
    <div class="text-2xl font-bold text-primary tracking-tight flex items-center gap-2">
      <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6" />
      </svg>
      CampusHome Admin
    </div>
    <a href="{{ route('admin.logout') }}" class="text-red-600 hover:underline font-semibold transition duration-200">
      Déconnexion
    </a>
  </nav>

  <!-- Contenu principal -->
  <main class="p-6 max-w-7xl mx-auto">
    <h1 class="text-3xl font-bold text-center mb-10 text-gray-800">Tableau de bord administratif</h1>

    <!-- Grille des cartes -->
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
      <!-- Carte -->
      @php
        $cards = [
          [
            'title' => 'Logements à valider',
            'route' => route('admin.logements.index'),
            'color' => 'primary',
            'icon' => 'home',
            'text' => 'Logements à valider',
          ],
          [
            'title' => 'Utilisateurs',
            'route' => route('admin.users.index'),
            'color' => 'secondary',
            'icon' => 'users',
            'text' => 'Gérer étudiants & propriétaires',
          ],
          [
            'title' => 'Paiements',
            'route' => route('admin.paiements.index'),
            'color' => 'accent',
            'icon' => 'credit-card',
            'text' => 'Voir les transactions',
          ],
          [
            'title' => 'Contrats de location',
            'route' => route('admin.contrats.index'),
            'color' => 'yellow-500',
            'icon' => 'file-text',
            'text' => 'Consulter les contrats',
          ],
          [
            'title' => 'Signalements maintenance',
            'route' => route('admin.maintenances.index'),
            'color' => 'red-500',
            'icon' => 'wrench',
            'text' => 'Voir les problèmes signalés',
          ],
          [
            'title' => 'Avis étudiants',
            'route' => route('admin.avis.index'),
            'color' => 'purple-600',
            'icon' => 'message-circle',
            'text' => 'Lire les avis',
          ],
        ];
      @endphp

      @foreach ($cards as $card)
      <div class="bg-white rounded-2xl shadow hover:shadow-lg transition-shadow p-6">
        <div class="flex items-center mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-{{ $card['color'] }} mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            @switch($card['icon'])
              @case('home') <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6" /> @break
              @case('users') <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-5-4M9 12a4 4 0 100-8 4 4 0 000 8zM7 20h10v-2a4 4 0 00-4-4H7a4 4 0 00-4 4v2z" /> @break
              @case('credit-card') <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h16v4H4z M4 12h16v8H4z" /> @break
              @case('file-text') <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6M9 16h6M13 4H6a2 2 0 00-2 2v16l4-4h10a2 2 0 002-2V6a2 2 0 00-2-2h-3z" /> @break
              @case('wrench') <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 11-5.656-5.656m2.828-2.828l4.242 4.242M14 10l4 4" /> @break
              @case('message-circle') <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" /> @break
            @endswitch
          </svg>
          <h2 class="text-lg font-semibold text-gray-700">{{ $card['title'] }}</h2>
        </div>
        <a href="{{ $card['route'] }}">
          <button class="mt-2 bg-{{ $card['color'] }} text-white px-4 py-2 rounded hover:bg-opacity-80 transition duration-200">
            {{ $card['text'] }}
          </button>
        </a>
      </div>
      @endforeach

    </div>
  </main>

</body>
</html>
