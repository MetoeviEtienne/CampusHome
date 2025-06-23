<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Créer un compte Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <style>
        /* Animations des bulles */
        .bubbles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            pointer-events: none;
            overflow: hidden;
            z-index: 0;
        }

        .bubble {
            position: absolute;
            bottom: -100px;
            background: rgba(99, 102, 241, 0.3);
            border-radius: 50%;
            opacity: 0.7;
            animation: rise 12s linear infinite;
            filter: drop-shadow(0 0 5px rgba(99, 102, 241, 0.6));
        }

        .bubble:nth-child(1) { width: 60px; height: 60px; left: 10%; animation-duration: 14s; }
        .bubble:nth-child(2) { width: 40px; height: 40px; left: 30%; animation-duration: 10s; animation-delay: 2s; }
        .bubble:nth-child(3) { width: 80px; height: 80px; left: 50%; animation-duration: 18s; animation-delay: 4s; }
        .bubble:nth-child(4) { width: 30px; height: 30px; left: 70%; animation-duration: 13s; animation-delay: 1s; }
        .bubble:nth-child(5) { width: 50px; height: 50px; left: 85%; animation-duration: 15s; animation-delay: 3s; }

        @keyframes rise {
            0%   { bottom: -100px; transform: translateX(0) scale(1); opacity: 0.7; }
            50%  { opacity: 0.4; }
            100% { bottom: 110vh; transform: translateX(50px) scale(1.2); opacity: 0; }
        }
    </style>
</head>

<body class="bg-cover bg-center bg-no-repeat min-h-screen flex items-center justify-center relative"
      style="background-image: url('https://img.freepik.com/free-vector/geometric-gradient-futuristic-background_23-2149116406.jpg?semt=ais_hybrid&w=740');">

    <!-- Bulles animées -->
    <div class="bubbles" aria-hidden="true">
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
    </div>

    <!-- Formulaire admin register -->
    <div class="backdrop-blur-md bg-gradient-to-br from-white/80 via-indigo-100/80 to-purple-100/80 p-8 rounded-2xl shadow-lg w-full max-w-md z-10 mx-4"
         style="box-shadow: 0 8px 24px rgba(99, 102, 241, 0.3);">
        <h2 class="text-3xl font-bold text-center text-indigo-700 mb-6">Administrateur</h2>

        <form method="POST" action="{{ route('admin.register.submit') }}" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-white mb-1">Nom complet</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    required
                    placeholder="Entrez votre nom complet"
                    class="w-full px-4 py-3 rounded-md bg-white text-gray-900 border border-gray-300 shadow-sm focus:ring-4 focus:ring-indigo-300 focus:outline-none transition"
                />
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-white mb-1">Email</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    required
                    placeholder="Entrez votre email"
                    class="w-full px-4 py-3 rounded-md bg-white text-gray-900 border border-gray-300 shadow-sm focus:ring-4 focus:ring-indigo-300 focus:outline-none transition"
                />
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-white mb-1">Mot de passe</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    required
                    placeholder="Mot de passe"
                    class="w-full px-4 py-3 rounded-md bg-white text-gray-900 border border-gray-300 shadow-sm focus:ring-4 focus:ring-indigo-300 focus:outline-none transition"
                />
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-white mb-1">Confirmer mot de passe</label>
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    required
                    placeholder="Confirmer mot de passe"
                    class="w-full px-4 py-3 rounded-md bg-white text-gray-900 border border-gray-300 shadow-sm focus:ring-4 focus:ring-indigo-300 focus:outline-none transition"
                />
            </div>

            <button
                type="submit"
                class="w-full py-3 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 transition duration-300"
            >
                Créer le compte
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-white">
            Déjà un compte ?
            <a href="{{ route('admin.login') }}" class="text-indigo-700 hover:text-indigo-800 font-semibold">
                Se connecter
            </a>
        </p>
    </div>

</body>
</html>
