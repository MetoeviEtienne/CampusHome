<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Erreur') - CampusHome</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" />
    @vite('resources/css/app.css') {{-- si tu utilises Vite --}}
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="min-h-screen flex flex-col items-center justify-center px-4">
        {{-- Contenu personnalisé --}}
        @yield('content')
    </div>

</body>
</html>
