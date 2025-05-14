<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CampusHome AdminDashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

  <!-- Navbar -->
  <nav class="bg-white shadow-md px-6 py-4 flex items-center justify-between">
    <div class="text-xl font-bold text-blue-600">
      CampusHome
    </div>
    <a href="{{ route('admin.logout') }}" class="text-red-600 hover:underline font-semibold">
      Déconnexion
    </a>
  </nav>

  <!-- Contenu principal -->
  <div class="min-h-screen p-6">
    <h1 class="text-2xl font-bold mb-6 text-center mt-6">DASHBOARD ADMINISTRATIF</h1>

    <!-- Grille des fonctionnalités -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

      <!-- Logements à valider -->
      <div class="bg-white p-4 rounded-2xl shadow">
        <h2 class="text-lg font-semibold mb-2">Logements à valider</h2>
        <a href="{{ route('admin.logements.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
          Voir les logements
        </a>
      
      </div>

      <!-- Gestion des utilisateurs -->
      <div class="bg-white p-4 rounded-2xl shadow">
        <h2 class="text-lg font-semibold mb-2">Utilisateurs</h2>
        <a href="{{ route('admin.users.index') }}">
          <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Gérer étudiants & propriétaires
          </button>
        </a>
      </div>


      <!-- Paiements -->
      <div class="bg-white p-4 rounded-2xl shadow">
        <h2 class="text-lg font-semibold mb-2">Paiements</h2>
        <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
          Voir les transactions
        </button>
      </div>

      <!-- Contrats signés -->
      <div class="bg-white p-4 rounded-2xl shadow">
        <h2 class="text-lg font-semibold mb-2">Contrats de location</h2>
        <button class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">
          Consulter les contrats
        </button>
      </div>

     <!-- Signalements de maintenance -->
    <div class="bg-white p-4 rounded-2xl shadow">
      <h2 class="text-lg font-semibold mb-2">Signalements de maintenance</h2>
      <a href="{{ route('admin.maintenances.index') }}">
          <button class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
              Voir les problèmes signalés
          </button>
      </a>
    </div>

      <!-- Avis -->
      <div class="bg-white p-4 rounded-2xl shadow">
        <h2 class="text-lg font-semibold mb-2">Avis étudiants</h2>
        <a href="{{ route('admin.avis.index') }}">
            <button class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
                Lire les avis
            </button>
        </a>
      </div>
    </div>
  </div>
</body>
</html>
