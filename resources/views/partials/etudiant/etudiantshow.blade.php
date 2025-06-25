<nav class="bg-blue-600 shadow text-white mb-6 fixed top-0 left-0 w-full z-50">
  <div class="max-w-7xl mx-auto px-4 py-3 flex flex-wrap items-center justify-between">

 <!-- Logo + Nom utilisateur -->
<div class="flex-shrink-0 mb-2 sm:mb-0 flex flex-col items-center">
  <!-- Logo -->
  <a href="{{ url('/') }}">
    <img src="{{ asset('images/logo2.png') }}" alt="CampusHome" style="width:50px;" />
  </a>

  <!-- Texte CampusHome (en dessous du logo) -->
  <div class="text-xl font-bold mt-1 flex items-center space-x-1">
    <span class="text-white">Campus</span>
    <span class="text-green-500">Home</span>
  </div>
</div>


    <!-- Bouton hamburger visible sur mobile (sm:hidden) -->
    <button id="menu-btn" class="sm:hidden ml-4 focus:outline-none" aria-label="Toggle menu">
      <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
           xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16"></path>
      </svg>
    </button>

    <!-- Menu boutons : visible sur desktop, caché sur mobile -->
    <div id="menu" class="hidden sm:flex sm:items-center sm:gap-4 sm:order-2 w-full sm:w-auto mt-4 sm:mt-0">
      <a href="{{ route('dashboard') }}"
         class="text-white px-4 py-2 rounded-md text-sm font-semibold border border-white hover:bg-white hover:text-blue-600 transition whitespace-nowrap">
        Accueil
      </a>

      <a href="{{ route('etudiant.reservations.index') }}"
         class="text-white px-4 py-2 rounded-md text-sm font-semibold border border-white hover:bg-white hover:text-blue-600 transition whitespace-nowrap">
        Mes réservations
      </a>

      <a href="{{ route('colocations.index') }}"
         class="text-white px-4 py-2 rounded-md text-sm font-semibold border border-white hover:bg-white hover:text-blue-600 transition whitespace-nowrap">
         Voir annonce ({{ $nbAnnonces }})
      </a>

      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
                class="text-white px-4 py-2 rounded-md text-sm font-semibold border border-red-300 hover:bg-red-500 hover:text-white transition whitespace-nowrap">
          Déconnexion
        </button>
      </form>
    </div>

  </div>

  <!-- Menu boutons mobile (vertical) -->
  <div id="mobile-menu" class="sm:hidden hidden px-4 pb-4 border-t border-blue-500 bg-blue-700">
    <div class="flex flex-col items-center gap-3">
      <a href="{{ route('dashboard') }}"
         class="text-white px-3 py-2 rounded-md text-sm font-semibold border border-white hover:bg-white hover:text-blue-600 transition whitespace-nowrap w-full text-center">
        Accueil
      </a>

      <a href="{{ route('etudiant.reservations.index') }}"
         class="text-white px-3 py-2 rounded-md text-sm font-semibold border border-white hover:bg-white hover:text-blue-600 transition whitespace-nowrap w-full text-center">
        Mes réservations
      </a>

      <a href="{{ route('colocations.index') }}"
          class="text-white px-3 py-2 rounded-md text-sm font-semibold border border-white hover:bg-white hover:text-blue-600 transition whitespace-nowrap w-full text-center">
          Voir annonce ({{ $nbAnnonces }})
      </a>

      <form method="POST" action="{{ route('logout') }}" class="w-full">
        @csrf
        <button type="submit"
                class="text-white px-3 py-2 rounded-md text-sm font-semibold border border-red-300 hover:bg-red-500 hover:text-white transition whitespace-nowrap w-full text-center">
          Déconnexion
        </button>
      </form>
    </div>
  </div>

  <script>
    const btn = document.getElementById('menu-btn');
    const menu = document.getElementById('mobile-menu');

    btn.addEventListener('click', () => {
      menu.classList.toggle('hidden');
    });
  </script>
</nav>
