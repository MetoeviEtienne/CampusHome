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
                            <a href="{{ route('contact.index') }}" class="bg-white text-blue-600 px-6 py-3 rounded-full font-semibold hover:bg-gray-100">
                                Contactez-nous
                            </a>
                            <a href="{{ route('a-savoir') }}" class="bg-transparent border border-white text-white px-6 py-3 rounded-full font-semibold hover:bg-white hover:text-blue-600">A savoir plus</a>
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
                           <a href="{{ route('contact.index') }}" class="bg-white text-blue-600 px-6 py-3 rounded-full font-semibold hover:bg-gray-100">
                                Contactez-nous
                            </a>
                            <a href="{{ route('a-savoir') }}"  class="bg-transparent border border-white text-white px-6 py-3 rounded-full font-semibold hover:bg-white hover:text-blue-600">A savoir plus</a>
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
                            <a href="{{ route('contact.index') }}" class="bg-white text-blue-600 px-6 py-3 rounded-full font-semibold hover:bg-gray-100">
                                Contactez-nous
                            </a>
                            <a href="{{ route('a-savoir') }}"  class="bg-transparent border border-white text-white px-6 py-3 rounded-full font-semibold hover:bg-white hover:text-blue-600">A savoir plus</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- À propos de CampusHome -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-5xl font-bold mb-6 text-blue-800">Trouvez votre logement étudiant en toute simplicité</h2>
        <p class="text-lg md:text-xl text-gray-700 max-w-3xl mx-auto">
            CampusHome est votre partenaire logement idéal. Explorez des offres vérifiées, réservez en quelques clics, échangez avec les propriétaires et payez en toute sécurité, le tout depuis un seul endroit.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
            <!-- Flexibilité -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <img src="https://i.pinimg.com/736x/65/3f/a3/653fa38cd891a022ac5a50b61a343e06.jpg" alt="Flexibilité" class="mx-auto mb-4">
                <h3 class="text-xl font-semibold mb-2 text-blue-700">Flexibilité maximale</h3>
                <p class="text-gray-600">
                    Recherchez selon vos critères : proximité du campus, type de logement, budget... vous êtes libre de choisir.
                </p>
            </div>

            <!-- Sécurité -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <img src="https://i.pinimg.com/736x/4b/15/ec/4b15ecbb84bb2e1bd22f82cb7db303b7.jpg" alt="Sécurité" class="mx-auto mb-4">
                <h3 class="text-xl font-semibold mb-2 text-blue-700">Transactions sécurisées</h3>
                <p class="text-gray-600">
                    Réservations et paiements sont protégés pour garantir votre tranquillité. Zéro stress, zéro surprise.
                </p>
            </div>

            <!-- Communauté -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <img src="https://i.pinimg.com/736x/e7/22/fd/e722fdbd0d5da4c6a6c09e0b8b915324.jpg" alt="Communauté" class="mx-auto mb-4">
                <h3 class="text-xl font-semibold mb-2 text-blue-700">Une vraie communauté</h3>
                <p class="text-gray-600">
                    Rejoignez des milliers d’étudiants et échangez avec des propriétaires de confiance. L’entraide commence ici.
                </p>
            </div>

            <!-- Rapidité -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <img src="https://i.pinimg.com/736x/47/72/d5/4772d5ae19f23190903c283af02f7b00.jpg" alt="Rapidité" class="mx-auto mb-4 ">
                <h3 class="text-xl font-semibold mb-2 text-blue-700">Réservation instantanée</h3>
                <p class="text-gray-600">
                    Plus besoin d'attendre : dès que vous trouvez le bon logement, vous pouvez réserver immédiatement.
                </p>
            </div>

            <!-- Suivi & gestion -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <img src="https://i.pinimg.com/736x/af/e0/0f/afe00fa33fc676706eee5c7e21c9ae89.jpg" alt="Suivi" class="mx-auto mb-4">
                <h3 class="text-xl font-semibold mb-2 text-blue-700">Tout sous contrôle</h3>
                <p class="text-gray-600">
                    Suivez vos réservations, paiements, avis et discussions depuis votre tableau de bord personnel.
                </p>
            </div>

            <!-- Accessibilité -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <img src="https://i.pinimg.com/736x/37/f1/52/37f152f43481ed3f9ea23f2f7cb248a9.jpg" alt="Accessibilité" class="mx-auto mb-4">
                <h3 class="text-xl font-semibold mb-2 text-blue-700">Accessible partout</h3>
                <p class="text-gray-600">
                    Une plateforme responsive, accessible 24h/24 sur mobile ou ordinateur. CampusHome vous suit partout.
                </p>
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
