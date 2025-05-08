<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusHome</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .carousel {
            position: relative;
            width: 100%;
            overflow: hidden;
           
        }
        .carousel-item {
            display: none;
            background-size: cover;
            background-position: center;
            height: 88vh; /* Hauteur pleine de l'écran */
     
        }
        .carousel-item.active {
            display: block;
        }
        .carousel-content {
            position: relative;
            z-index: 1;
            color: white;
            text-align: center;
            top: 50%;
            transform: translateY(-50%);
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.2); /* Overlay semi-transparent */
            border-radius: 1rem; /* Ajouter un border-radius */
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 font-sans">
    <!-- Navbar -->
<nav class="bg-white shadow-md fixed top-0 left-0 w-full z-50">
    <div class="container mx-auto px-4 py-4 flex items-center justify-between">
        <!-- Logo / Nom -->
        <div class="text-2xl font-bold text-blue-600">
            <a href="#" class="hover:text-blue-800">CampusHome</a>
        </div>

        <!-- Boutons -->
        <div class="space-x-4">
            <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">Connexion</a>
            <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 font-semibold">S'inscrire</a>
        </div>
    </div>
</nav>

<!-- Espacement pour éviter que le carousel ne soit caché sous la navbar -->
<div class="h-20"></div>


    <!-- Hero Section avec Carousel -->
    <section class="relative bg-blue-600 text-white">
        <div class="carousel">
            <!-- Diapositive 1 -->
            <div class="carousel-item active" style="background-image: url('https://i.pinimg.com/736x/ee/e9/f4/eee9f4fc9dbe205f4bd75e75153e1dda.jpg');">
                <div class="overlay"></div>
                <div class="carousel-content">
                    <div class="container mx-auto px-4 py-24 text-center">
                        <h1 class="text-4xl md:text-6xl font-bold mb-4">Plateforme de recherche de location des étudiants</h1>
                        <p class="text-lg md:text-xl mb-8">Trouvez votre logement étudiant idéal et simplifiez votre vie académique.</p>
                        <div class="space-x-4">
                            <a href="{{ route('register') }}" class="bg-white text-blue-600 px-6 py-3 rounded-full font-semibold hover:bg-gray-100">S'inscrire</a>
                            <a href="{{ route('register') }}" class="bg-transparent border border-white text-white px-6 py-3 rounded-full font-semibold hover:bg-white hover:text-blue-600">Explorer</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Diapositive 2 -->
            <div class="carousel-item" style="background-image: url('https://i.pinimg.com/736x/26/46/d7/2646d7160e99fb0c4782eda892ae02d8.jpg');">
                <div class="overlay"></div>
                <div class="carousel-content">
                    <div class="container mx-auto px-4 py-24 text-center">
                        <h1 class="text-4xl md:text-6xl font-bold mb-4">Votre maison proche de chez vous</h1>
                        <p class="text-lg md:text-xl mb-8">Des logements adaptés à vos besoins et à votre budget.</p>
                        <div class="space-x-4">
                            <a href="{{ route('register') }}" class="bg-white text-blue-600 px-6 py-3 rounded-full font-semibold hover:bg-gray-100">S'inscrire</a>
                            <a href="{{ route('register') }}" class="bg-transparent border border-white text-white px-6 py-3 rounded-full font-semibold hover:bg-white hover:text-blue-600">Explorer</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Diapositive 3 -->
            <div class="carousel-item" style="background-image: url('https://i.pinimg.com/736x/81/5d/cd/815dcd98a7b75e4636aaed5eb3fe444a.jpg');">
                <div class="overlay"></div>
                <div class="carousel-content">
                    <div class="container mx-auto px-4 py-24 text-center">
                        <h1 class="text-4xl md:text-6xl font-bold mb-4">Votre maison proche de chez vous</h1>
                        <p class="text-lg md:text-xl mb-8">Des logements adaptés à vos besoins et à votre budget.</p>
                        <div class="space-x-4">
                            <a href="{{ route('register') }}" class="bg-white text-blue-600 px-6 py-3 rounded-full font-semibold hover:bg-gray-100">S'inscrire</a>
                            <a href="{{ route('register') }}" class="bg-transparent border border-white text-white px-6 py-3 rounded-full font-semibold hover:bg-white hover:text-blue-600">Explorer</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- À propos de DashboardCampus -->
    <section class="py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-5xl font-bold mb-8">À propos de CampusHome</h2>
            <p class="text-lg md:text-xl mb-8">CampusHome est une plateforme dédiée aux étudiants pour simplifier la recherche de logements, la gestion des réservations et les paiements en ligne. Nous offrons une expérience fluide et sécurisée pour que vous puissiez vous concentrer sur vos études.</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <img src="https://via.placeholder.com/80?text=Icon" alt="Icon" class="mx-auto mb-4">
                    <h3 class="text-xl font-semibold mb-2">Flexibilité</h3>
                    <p class="text-gray-600">Trouvez des logements adaptés à vos besoins et à votre emploi du temps.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <img src="https://via.placeholder.com/80?text=Icon" alt="Icon" class="mx-auto mb-4">
                    <h3 class="text-xl font-semibold mb-2">Sécurité</h3>
                    <p class="text-gray-600">Des paiements sécurisés et une gestion transparente des réservations.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <img src="https://via.placeholder.com/80?text=Icon" alt="Icon" class="mx-auto mb-4">
                    <h3 class="text-xl font-semibold mb-2">Communauté</h3>
                    <p class="text-gray-600">Rejoignez une communauté d'étudiants et de propriétaires engagés.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <img src="https://via.placeholder.com/80?text=Icon" alt="Icon" class="mx-auto mb-4">
                    <h3 class="text-xl font-semibold mb-2">Flexibilité</h3>
                    <p class="text-gray-600">Trouvez des logements adaptés à vos besoins et à votre emploi du temps.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <img src="https://via.placeholder.com/80?text=Icon" alt="Icon" class="mx-auto mb-4">
                    <h3 class="text-xl font-semibold mb-2">Sécurité</h3>
                    <p class="text-gray-600">Des paiements sécurisés et une gestion transparente des réservations.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <img src="https://via.placeholder.com/80?text=Icon" alt="Icon" class="mx-auto mb-4">
                    <h3 class="text-xl font-semibold mb-2">Communauté</h3>
                    <p class="text-gray-600">Rejoignez une communauté d'étudiants et de propriétaires engagés.</p>
                </div>
            </div>
        </div>
    </section>
    

    <!-- Footer -->
    <footer class="bg-blue-600 text-white py-8">
        <div class="container mx-auto px-4 text-center">
            <p class="text-lg">&copy; 2025 CampusHome. Tous droits réservés.</p>
        </div>
    </footer>

    <script>
        // Carousel JavaScript
        let currentIndex = 0;
        const slides = document.querySelectorAll('.carousel-item');

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.remove('active');
                if (i === index) {
                    slide.classList.add('active');
                }
            });
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % slides.length;
            showSlide(currentIndex);
        }

        setInterval(nextSlide, 5000); // Change slide every 5 seconds
    </script>
</body>
</html>
