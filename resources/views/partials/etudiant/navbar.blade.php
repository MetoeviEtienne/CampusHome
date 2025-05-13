<nav class="bg-blue-600 shadow text-white mb-6">
    <div class="max-w-7xl mx-auto px-4 py-3 flex flex-wrap sm:flex-nowrap items-center justify-between">

        <!-- Logo + Nom de l'utilisateur -->
        <div class="text-center sm:text-left mb-2 sm:mb-0">
            <div class="text-2xl font-bold">CampusHome</div>
            @auth
                <div class="text-sm font-light text-white">Bienvenue, {{ Auth::user()->name }}</div>
            @endauth
        </div>

        <!-- Liens de navigation stylisés avec hover uniquement -->
    <div class="flex justify-center flex-wrap gap-2 sm:gap-4 mb-2 sm:mb-0">
        <a href="{{ route('dashboard') }}"
        class="text-white px-4 py-2 rounded-md text-sm font-semibold border border-white hover:bg-white hover:text-blue-600 transition">
            Accueil
        </a>

        <a href="{{ route('etudiant.reservations.index') }}"
        class="text-white px-4 py-2 rounded-md text-sm font-semibold border border-white hover:bg-white hover:text-blue-600 transition">
            Demander réservations
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="text-white px-4 py-2 rounded-md text-sm font-semibold border border-red-300 hover:bg-red-500 hover:text-white transition">
                Déconnexion
            </button>
        </form>
    </div>


        <!-- Barre de recherche -->
        <div class="w-full sm:w-auto">
            <form action="{{ route('etudiant.logements.index') }}" method="GET" class="flex items-center gap-2">
                <input type="text" name="search" placeholder="Ville ou loyer..."
                       class="px-3 py-2 rounded-md text-gray-800 w-64 focus:outline-none focus:ring-2 focus:ring-blue-400" />
                <button type="submit"
                        class="bg-white text-blue-600 px-4 py-2 rounded-md text-sm font-semibold hover:bg-blue-100 transition">
                    Rechercher
                </button>
            </form>
        </div>
    </div>
</nav>
