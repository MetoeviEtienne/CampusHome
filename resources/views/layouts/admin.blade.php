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
    
    <style>
        body, html {
            overflow-x: hidden; /* Evite scroll horizontal */
        }
    </style>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }

        function adjustMainMargin() {
            const sidebar = document.getElementById('sidebar');
            const main = document.querySelector('main');
            if(window.innerWidth >= 768) {
                main.style.marginLeft = sidebar.offsetWidth + 'px';
                sidebar.classList.remove('-translate-x-full');
            } else {
                main.style.marginLeft = '0';
                sidebar.classList.add('-translate-x-full');
            }
        }

        window.addEventListener('resize', adjustMainMargin);
        window.addEventListener('load', adjustMainMargin);

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('#sidebar nav a').forEach(link => {
                link.addEventListener('click', () => {
                    if(window.innerWidth < 768) {
                        toggleSidebar();
                    }
                });
            });
        });
    </script>
</head>
<body class="bg-gray-100 font-sans antialiased min-h-screen">

    <!-- Mobile Header -->
    <div
        class="md:hidden fixed top-0 left-0 right-0 flex items-center justify-between bg-white p-4 shadow z-40"
    >
        <button onclick="toggleSidebar()" class="text-gray-600 focus:outline-none" aria-label="Toggle menu">
            ☰
        </button>
        {{-- <h1 class="text-lg font-semibold text-blue-600">CampusHome</h1> --}}
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="text-red-500 text-sm font-semibold">Déconnexion</button>
        </form>
    </div>

    <!-- Sidebar -->
    <aside
        id="sidebar"
        class="fixed top-0 left-0 h-full w-64 bg-white shadow-md z-50
               transform -translate-x-full md:translate-x-0
               transition-transform duration-200 ease-in-out"
    >
        <div class="p-6 border-b text-center">
            <h2 class="text-xl font-bold text-blue-600 mb-1">CampusHome</h2>
            <p class="text-gray-500 font-semibold">Admin</p>
        </div>
        <nav class="mt-6">
            <ul class="space-y-1">
                <li><a href="{{ route('admin.dashboard') }}" class="block px-6 py-3 text-gray-700 hover:bg-blue-100 hover:text-blue-600 font-medium rounded transition">🏠 Tableau de bord</a></li>
                <li><a href="{{ route('admin.users.index') }}" class="block px-6 py-3 text-gray-700 hover:bg-blue-100 hover:text-blue-600 font-medium rounded transition">👥 Gérer utilisateurs</a></li>
                <li><a href="{{ route('admin.admins.index') }}" class="block px-6 py-3 text-gray-700 hover:bg-blue-100 hover:text-blue-600 font-medium rounded transition">🧑‍💼 Administrateurs</a></li>
                <li><a href="{{ route('admin.logements.historique') }}" class="block px-6 py-3 text-gray-700 hover:bg-blue-100 hover:text-blue-600 font-medium rounded transition">📜 Historique</a></li>
                <li><a href="{{ route('admin.reservations.index') }}" class="block px-6 py-3 text-gray-700 hover:bg-blue-100 hover:text-blue-600 font-medium rounded transition">📅 Réservations</a></li>
                <li><a href="{{ route('admin.statistiques') }}" class="block px-6 py-3 text-gray-700 hover:bg-green-100 hover:text-green-600 font-medium rounded transition">📊 Statistiques</a></li>
                <li><a href="{{ route('admin.contact.index') }}" class="block px-6 py-3 text-gray-700 hover:bg-blue-100 hover:text-blue-600 font-medium rounded transition">📬 Messages</a></li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main
        class="flex-1 overflow-y-auto bg-gray-100 min-h-screen"
        style="margin-left: 0; padding-top: 4rem;" 
        {{-- padding top = hauteur header --}}
    >
        <!-- Header desktop fixe -->
        <header
            class="hidden md:flex fixed top-0 left-64 right-0 bg-white shadow p-4 justify-between items-center z-30"
            style="height: 4rem;"
        >
            <h1 class="text-xl font-semibold text-gray-800 mx-auto">Tableau de bord</h1>
            <div class="flex items-center space-x-3 absolute right-4">
                <span class="text-sm text-gray-600">
                    Connecté en tant que
                    <strong class="text-blue-600">{{ Auth::guard('admin')->user()->name }}</strong>
                </span>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-sm">
                        Déconnexion
                    </button>
                </form>
            </div>
        </header>

        <div class="p-6 max-w-full">
            @yield('content')
        </div>
    </main>

</body>
</html>
