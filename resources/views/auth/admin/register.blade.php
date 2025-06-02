<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Créer un compte Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <style>
        /* Bulles animées */
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

    <!-- Bulles animées -->
    <div class="bubbles" aria-hidden="true">
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
    </div>

    <div class="bg-white p-8 rounded-xl shadow-xl w-full max-w-md relative z-10
        transform transition duration-500 hover:scale-105">
        <h2 class="text-2xl font-bold text-center text-indigo-600 mb-6">Administrateur</h2>

        <form method="POST" action="{{ route('admin.register.submit') }}" class="space-y-4 text-sm">
            @csrf

            <div>
                <label for="name" class="block text-gray-700 mb-1 font-medium">Nom complet</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    placeholder="Nom complet"
                    required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm
                           focus:outline-none focus:ring-3 focus:ring-indigo-400 focus:border-indigo-500
                           transition text-sm"
                />
            </div>

            <div>
                <label for="email" class="block text-gray-700 mb-1 font-medium">Email</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    placeholder="Email"
                    required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm
                           focus:outline-none focus:ring-3 focus:ring-indigo-400 focus:border-indigo-500
                           transition text-sm"
                />
            </div>

            <div>
                <label for="password" class="block text-gray-700 mb-1 font-medium">Mot de passe</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Mot de passe"
                    required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm
                           focus:outline-none focus:ring-3 focus:ring-indigo-400 focus:border-indigo-500
                           transition text-sm"
                />
            </div>

            <div>
                <label for="password_confirmation" class="block text-gray-700 mb-1 font-medium">Confirmer mot de passe</label>
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    placeholder="Confirmer mot de passe"
                    required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm
                           focus:outline-none focus:ring-3 focus:ring-indigo-400 focus:border-indigo-500
                           transition text-sm"
                />
            </div>

            <button
                type="submit"
                class="w-full py-2 bg-indigo-600 text-white font-semibold rounded-md
                       hover:bg-indigo-700 focus:outline-none focus:ring-3 focus:ring-indigo-500
                       transition duration-300 text-sm"
            >
                Créer le compte
            </button>
        </form>

        @if ($errors->any())
            <div class="mt-4 text-red-500 text-xs space-y-1">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="mt-4 text-center text-xs text-gray-600">
            <a href="{{ route('admin.login') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">
                Déjà inscrit ? Connexion
            </a>
        </div>
    </div>

</body>
</html>
