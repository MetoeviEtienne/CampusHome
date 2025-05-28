<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord étudiant</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @yield('head') {{-- Pour charger des scripts spécifiques dans les vues --}}
</head>
<body class="bg-gray-100 font-sans pt-24">
    @include('partials.etudiant.etudiantshow')

    <main class="py-8">
        @yield('content')
    </main>

    @yield('scripts') {{-- Pour charger JS spécifique (ex : KKiaPay) --}}
</body>
</html>
