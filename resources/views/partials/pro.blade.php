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
  </div>

  <script>
    const btn = document.getElementById('menu-btn');
    const menu = document.getElementById('mobile-menu');

    btn.addEventListener('click', () => {
      menu.classList.toggle('hidden');
    });
  </script>
</nav>
