<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Espace Propriétaire')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <script>
        function toggleProprioMenu() {
            document.getElementById('proprio-nav-mobile').classList.toggle('hidden');
        }
    </script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans antialiased">

    @php
        $nombreNotificationsNonLues = Auth::check() ? Auth::user()->unreadNotifications->count() : 0;
    @endphp

    <!-- Header / Navigation -->
    <nav class="bg-gradient-to-r from-blue-700 to-blue-900 text-white px-4 py-4 shadow-lg sticky top-0 z-50">
        <div class="flex justify-between items-center max-w-7xl mx-auto">
            <!-- Logo -->
            <a href="{{ route('proprietaire.dashboard') }}" class="text-2xl font-extrabold tracking-wide">
                CampusHome
            </a>

            <!-- Hamburger menu (mobile) -->
            <button class="md:hidden text-white text-3xl focus:outline-none" onclick="toggleProprioMenu()">
                ☰
            </button>

            <!-- Desktop navigation -->
            <div id="proprio-nav-desktop" class="hidden md:flex items-center space-x-6 text-sm font-medium">
                <a href="{{ route('proprietaire.dashboard') }}" class="hover:text-blue-600 transition">Dashboard</a>
                <a href="{{ route('proprietaire.logements.index') }}" class="hover:text-gray-300 transition">Mes logements</a>
                <a href="{{ route('proprietaire.reservations.index') }}" class="hover:text-gray-300 transition">Réservations</a>
                <a href="{{ route('proprietaire.messages') }}" class="hover:text-gray-300 transition">Messagerie</a>
                <a href="{{ route('proprietaire.maintenances.index') }}" class="hover:text-gray-300 transition">Maintenance 🛠️</a>
                <a href="{{ route('proprietaire.avis.index') }}" class="hover:text-gray-300 transition">Avis 📝</a>
                <div class="relative">
                    <a href="{{ route('proprietaire.notifications.index') }}" class="hover:text-gray-300 transition">Notifications 🔔</a>
                    @if($nombreNotificationsNonLues > 0)
                        <span class="absolute -top-2 -right-3 bg-red-600 text-white text-xs font-semibold rounded-full px-1.5 py-0.5">
                            {{ $nombreNotificationsNonLues }}
                        </span>
                    @endif
                </div>
                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-400 focus:outline-none 
                               text-white px-4 py-2 rounded-lg shadow transition font-semibold">
                        Déconnexion
                    </button>
                </form>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div id="proprio-nav-mobile" class="md:hidden hidden flex-col space-y-3 px-4 pt-4 text-sm font-medium">
            <a href="{{ route('proprietaire.dashboard') }}" class="hover:text-blue-600 transition">Dashboard</a>
            <a href="{{ route('proprietaire.logements.index') }}" class="block hover:text-gray-300">Mes logements</a>
            <a href="{{ route('proprietaire.reservations.index') }}" class="block hover:text-gray-300">Réservations</a>
            <a href="{{ route('proprietaire.messages') }}" class="block hover:text-gray-300">Messagerie</a>
            <a href="{{ route('proprietaire.maintenances.index') }}" class="block hover:text-gray-300">Maintenance 🛠️</a>
            <a href="{{ route('proprietaire.avis.index') }}" class="block hover:text-gray-300">Avis 📝</a>
            <a href="{{ route('proprietaire.notifications.index') }}" class="block hover:text-gray-300 relative">
                Notifications 🔔
                @if($nombreNotificationsNonLues > 0)
                    <span class="absolute top-0 right-0 bg-red-600 text-white text-xs font-semibold rounded-full px-1.5 py-0.5 transform translate-x-2 -translate-y-1">
                        {{ $nombreNotificationsNonLues }}
                    </span>
                @endif
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                        class="bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-400 focus:outline-none 
                               text-white w-full py-2 rounded-lg shadow transition font-semibold">
                    Déconnexion
                </button>
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 py-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white mt-10 py-4 text-center text-sm text-gray-500 border-t">
        &copy; {{ date('Y') }} <span class="font-medium text-blue-700">CampusHome</span>. Tous droits réservés.
    </footer>

</body>
</html>
