<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    @php
        $nombreNotificationsNonLues = Auth::check() ? Auth::user()->unreadNotifications->count() : 0;
    @endphp

    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-gray-800">Espace Propriétaire</h1>
            <nav class="space-x-4 flex items-center">
                <a href="{{ route('proprietaire.dashboard') }}" class="text-gray-700 hover:text-blue-600 font-medium">Dashboard</a>
                <a href="{{ route('proprietaire.maintenances.index') }}" class="text-gray-700 hover:text-blue-600 font-medium">Maintenance 🛠️</a>
                <a href="{{ route('proprietaire.avis.index') }}" class="text-gray-700 hover:text-blue-600 font-medium">Avis 📝</a>

                <!-- Notifications avec badge -->
                <div class="relative inline-block">
                    <a href="{{ route('proprietaire.notifications.index') }}" class="text-gray-700 hover:text-blue-600 font-medium">
                        Notifications 🔔
                    </a>
                    @if($nombreNotificationsNonLues > 0)
                        <span class="absolute -top-2 -right-3 bg-red-600 text-white text-xs font-bold rounded-full px-1.5 py-0.5">
                            {{ $nombreNotificationsNonLues }}
                        </span>
                    @endif
                </div>

                <!-- Tu peux ajouter d'autres liens ici -->
            </nav>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 py-6">
        @yield('content')
    </main>

    <footer class="bg-white mt-10 py-4 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} CampusHome. Tous droits réservés.
    </footer>
</body>
</html>
