<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord étudiant</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    @include('partials.etudiant.etudiantshow')

    <main class="py-8">
        @yield('content')
    </main>
</body>
</html>
