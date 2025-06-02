<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Connexion Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <style>
        /* Conteneur des bulles */
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
        /* Bulles */
        .bubble {
            position: absolute;
            bottom: -100px;
            background: rgba(99, 102, 241, 0.3); /* Indigo clair */
            border-radius: 50%;
            opacity: 0.7;
            animation: rise 12s linear infinite;
            filter: drop-shadow(0 0 5px rgba(99, 102, 241, 0.6));
        }
        /* Animations différentes pour chaque bulle */
        .bubble:nth-child(1) {
            width: 60px;
            height: 60px;
            left: 10%;
            animation-duration: 14s;
            animation-delay: 0s;
        }
        .bubble:nth-child(2) {
            width: 40px;
            height: 40px;
            left: 30%;
            animation-duration: 10s;
            animation-delay: 2s;
        }
        .bubble:nth-child(3) {
            width: 80px;
            height: 80px;
            left: 50%;
            animation-duration: 18s;
            animation-delay: 4s;
        }
        .bubble:nth-child(4) {
            width: 30px;
            height: 30px;
            left: 70%;
            animation-duration: 13s;
            animation-delay: 1s;
        }
        .bubble:nth-child(5) {
            width: 50px;
            height: 50px;
            left: 85%;
            animation-duration: 15s;
            animation-delay: 3s;
        }

        /* Animation montée des bulles */
        @keyframes rise {
            0% {
                bottom: -100px;
                transform: translateX(0) scale(1);
                opacity: 0.7;
            }
            50% {
                opacity: 0.4;
            }
            100% {
                bottom: 110vh;
                transform: translateX(50px) scale(1.2);
                opacity: 0;
            }
        }

        /* Animation focus sur inputs */
        input:focus {
            animation: pulse 1s ease forwards;
        }

        @keyframes pulse {
            0%, 100% {
                box-shadow: 0 0 0 0 rgba(99, 102, 241, 0.7);
            }
            50% {
                box-shadow: 0 0 10px 4px rgba(99, 102, 241, 0.7);
            }
        }
    </style>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen relative overflow-hidden">

    <!-- Bulles animées en arrière-plan -->
    <div class="bubbles" aria-hidden="true">
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
    </div>

    <div class="bg-white p-10 rounded-xl shadow-xl w-full max-w-sm relative z-10
        transform transition duration-500 hover:scale-105">
        <h2 class="text-3xl font-bold text-center text-indigo-600 mb-8">Administrateur</h2>

        <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-6">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    placeholder="Email"
                    required
                    class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm
                           focus:outline-none focus:ring-4 focus:ring-indigo-400 focus:border-indigo-500
                           transition"
                />
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Mot de passe"
                    required
                    class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm
                           focus:outline-none focus:ring-4 focus:ring-indigo-400 focus:border-indigo-500
                           transition"
                />
            </div>

            <button
                type="submit"
                class="w-full py-3 bg-indigo-600 text-white font-semibold rounded-md
                       hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-500
                       transition duration-300"
            >
                Connexion
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-600">
            Pas encore de compte ?
            <a href="{{ route('admin.register') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">
                Créer un compte
            </a>
        </p>
    </div>

</body>
</html>
