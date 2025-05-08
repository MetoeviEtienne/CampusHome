<!-- resources/views/components/navbar.blade.php -->
<nav class="bg-white border-b border-gray-200 shadow-sm">
    <div class="container mx-auto px-4 flex items-center justify-between py-4">
        <!-- Logo -->
        <a href="/" class="text-2xl font-bold text-gray-800">CampusHome</a>

        <!-- Boutons -->
        <div class="space-x-4">
            <a href="{{ route('register') }}" class="px-4 py-2 bg-orange-500 text-white rounded-full hover:bg-orange-600">
                S'inscrire
            </a>
            <a href="{{ route('login') }}" class="px-4 py-2 border border-gray-400 text-gray-800 rounded-full hover:bg-gray-100">
                Se connecter
            </a>
        </div>
    </div>
</nav>
