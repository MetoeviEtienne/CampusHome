<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Mon Application')</title>

    <!-- Tailwind CSS + FontAwesome -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <style>
        @keyframes floatUp {
            0% { transform: translateY(0) scale(1); opacity: 1; }
            100% { transform: translateY(-100vh) scale(0.5); opacity: 0; }
        }
        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            animation-name: floatUp;
            animation-timing-function: linear;
            animation-iteration-count: infinite;
        }
        .particle-small { width: 6px; height: 6px; }
        .particle-medium { width: 10px; height: 10px; }
        .particle-large { width: 15px; height: 15px; }
        .background-image {
            background-image: url('https://images.unsplash.com/photo-1560184897-ae75f418493e');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body class="relative min-h-screen background-image bg-no-repeat bg-cover font-sans">

    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 bg-indigo-900 bg-opacity-80 backdrop-blur-sm shadow-md z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <h1 class="text-white font-bold text-xl select-none">CampusHome</h1>
            {{-- <div class="space-x-4">
                <a href="{{ route('login') }}" class="text-white hover:underline">Connexion</a>
                <a href="{{ route('register') }}" class="bg-white text-indigo-800 px-4 py-2 rounded hover:bg-indigo-100">S'inscrire</a>
            </div> --}}
        </div>
    </nav>

    <!-- Particules -->
    @php $sizes = ['particle-small', 'particle-medium', 'particle-large']; @endphp
    <div aria-hidden="true" class="pointer-events-none fixed inset-0 overflow-hidden -z-10">
        @for ($i = 0; $i < 100; $i++)
            @php $sizeClass = $sizes[array_rand($sizes)]; @endphp
            <div class="particle {{ $sizeClass }}"
                 style="left: {{ rand(0, 100) }}vw;
                        bottom: -20px;
                        animation-duration: {{ rand(10, 30) }}s;
                        animation-delay: {{ rand(0, 20) }}s;">
            </div>
        @endfor
    </div>

    <!-- Main Content -->
    <main class="flex justify-center items-center min-h-screen px-4 pt-20">
    <div class="bg-white/10 backdrop-blur-md p-6 md:p-8 rounded-xl shadow-xl w-full max-w-xl">
        @yield('content')
    </div>
    </main>

</body>
</html>
