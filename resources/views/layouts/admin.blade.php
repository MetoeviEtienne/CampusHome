@php
    if (!Auth::guard('admin')->check()) {
        abort(403, 'Accès non autorisé.');
    }
@endphp

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Panneau Admin</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('#sidebar nav a').forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth < 768) { // md breakpoint
                        toggleSidebar();
                    }
                });
            });
        });
    </script>
</head>
<body class="bg-gray-100 font-sans antialiased min-h-screen">

    <!-- Mobile Header -->
    <div class="md:hidden flex items-center justify-between bg-white p-4 shadow fixed w-full z-20 top-0">
        <button onclick="toggleSidebar()" class="text-gray-600 focus:outline-none" aria-label="Toggle menu">☰</button>
        {{-- <h1 class="text-lg font-semibold text-blue-600">CampusHome</h1> --}}
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="text-red-500 text-sm font-semibold">Déconnexion</button>
        </form>
    </div>

    <div class="flex h-screen pt-16 md:pt-0">

        <!-- Sidebar -->
        <aside
            id="sidebar"
            class="fixed md:sticky top-0 md:h-screen overflow-y-auto transform md:translate-x-0 -translate-x-full transition-transform duration-200 ease-in-out w-64 bg-white shadow-md z-30"
        >
            <div class="p-6 border-b text-center">
                <h2 class="text-xl font-bold text-blue-600 mb-1">CampusHome</h2>
                <p class="text-gray-500 font-semibold">Admin</p>
            </div>
            <nav class="mt-6">
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                           class="block px-6 py-3 text-gray-700 hover:bg-blue-100 hover:text-blue-600 font-medium rounded transition"
                        >
                            🏠 Tableau de bord
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}"
                           class="block px-6 py-3 text-gray-700 hover:bg-blue-100 hover:text-blue-600 font-medium rounded transition"
                        >
                            👥 Gérer utilisateurs
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.admins.index') }}"
                           class="block px-6 py-3 text-gray-700 hover:bg-blue-100 hover:text-blue-600 font-medium rounded transition"
                        >
                            🧑‍💼 Administrateurs
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.logements.historique') }}"
                           class="block px-6 py-3 text-gray-700 hover:bg-blue-100 hover:text-blue-600 font-medium rounded transition"
                        >
                            📜 Historique
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.reservations.index') }}"
                           class="block px-6 py-3 text-gray-700 hover:bg-blue-100 hover:text-blue-600 font-medium rounded transition"
                        >
                            📅 Réservations
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.statistiques') }}"
                           class="block px-6 py-3 text-gray-700 hover:bg-green-100 hover:text-green-600 font-medium rounded transition"
                        >
                            📊 Statistiques
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.contact.index') }}"
                           class="block px-6 py-3 text-gray-700 hover:bg-blue-100 hover:text-blue-600 font-medium rounded transition"
                        >
                            📬 Messages
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto bg-gray-100 md:ml-64 pt-16 md:pt-0" style="-webkit-overflow-scrolling: touch;">
            <header
                class="hidden md:flex bg-white shadow p-4 justify-between items-center sticky top-0 z-10"
            >
                <h1 class="text-xl font-semibold text-gray-800 mx-auto">Tableau de bord</h1>
                <div class="flex items-center space-x-3 absolute right-4">
                    <span class="text-sm text-gray-600">
                        Connecté en tant que
                        <strong class="text-blue-600">{{ Auth::guard('admin')->user()->name }}</strong>
                    </span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button
                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-sm"
                        >
                            Déconnexion
                        </button>
                    </form>
                </div>
            </header>

            <div class="p-6">
                @yield('content')
            </div>
        </main>
    </div>

</body>
</html>
