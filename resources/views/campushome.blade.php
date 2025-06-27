<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CampusHome</title>

    <!-- TailwindCSS v3 CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=typography"></script>

    <!-- Swiper.js CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Pré‑connexion pour de meilleures performances -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <style>
        /* Sur‑classe utilitaire pour la barre de navigation floutée */
        .glass {
            @apply bg-white/70 backdrop-blur-sm;
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-50">
    <!-- Navbar -->
    <nav class="glass fixed inset-x-0 top-0 z-50 shadow-sm">
        <div class="container mx-auto flex items-center justify-between px-4 py-3 md:py-4">
            <!-- Logo -->
            <a href="#" class="text-2xl font-black tracking-wide text-blue-600 hover:text-blue-800">CampusHome</a>

            <!-- Actions -->
            <div class="space-x-3 text-sm md:text-base">
                <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:underline">Connexion</a>
                <a href="{{ route('register') }}" class="inline-block rounded-full bg-blue-600 px-5 py-2 font-semibold text-white shadow hover:bg-blue-700 transition">S'inscrire</a>
            </div>
        </div>
    </nav>
    <!-- Spacer pour compenser la navbar -->
    <div class="h-16 md:h-20"></div>

    <!-- Hero & Carousel -->
    <section id="accueil" class="relative h-[85vh] md:h-[90vh]">
        <div class="swiper mySwiper h-full">
            <div class="swiper-wrapper">
                <!-- Slide 1 -->
                <div class="swiper-slide relative">
                    <img src="https://i.pinimg.com/736x/ee/e9/f4/eee9f4fc9dbe205f4bd75e75153e1dda.jpg" class="absolute inset-0 h-full w-full object-cover" alt="Logement étudiant" />
                    <div class="absolute inset-0 bg-black/40"></div>
                    <div class="relative z-10 flex h-full flex-col items-center justify-center px-4 text-center text-white">
                        <h1 class="mb-4 max-w-4xl text-4xl font-bold md:text-6xl">Plateforme de recherche de location pour étudiants</h1>
                        <p class="mb-8 max-w-xl text-lg md:text-xl">Trouvez votre logement idéal et simplifiez votre vie académique.</p>
                        <div class="flex flex-wrap justify-center gap-4">
                            <a href="{{ route('contact.index') }}" class="rounded-full bg-white px-6 py-3 font-semibold text-blue-600 shadow hover:bg-gray-100">Contactez‑nous</a>
                            <a href="{{ route('a-savoir') }}" class="rounded-full border border-white px-6 py-3 font-semibold text-white hover:bg-white hover:text-blue-600">En savoir plus</a>
                        </div>
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="swiper-slide relative">
                    <img src="https://i.pinimg.com/736x/26/46/d7/2646d7160e99fb0c4782eda892ae02d8.jpg" class="absolute inset-0 h-full w-full object-cover" alt="Maison étudiante" />
                    <div class="absolute inset-0 bg-blue-900/30"></div>
                    <div class="relative z-10 flex h-full flex-col items-center justify-center px-4 text-center text-white">
                        <h1 class="mb-4 max-w-4xl text-4xl font-bold md:text-6xl">Votre maison loin de la maison</h1>
                        <p class="mb-8 max-w-xl text-lg md:text-xl">Des logements adaptés à vos besoins et à votre budget.</p>
                        <div class="flex flex-wrap justify-center gap-4">
                            <a href="{{ route('contact.index') }}" class="rounded-full bg-white px-6 py-3 font-semibold text-blue-600 shadow hover:bg-gray-100">Contactez‑nous</a>
                            <a href="{{ route('a-savoir') }}" class="rounded-full border border-white px-6 py-3 font-semibold text-white hover:bg-white hover:text-blue-600">En savoir plus</a>
                        </div>
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="swiper-slide relative">
                    <img src="https://i.pinimg.com/736x/81/5d/cd/815dcd98a7b75e4636aaed5eb3fe444a.jpg" class="absolute inset-0 h-full w-full object-cover" alt="Chambre étudiante" />
                    <div class="absolute inset-0 bg-black/40"></div>
                    <div class="relative z-10 flex h-full flex-col items-center justify-center px-4 text-center text-white">
                        <h1 class="mb-4 max-w-4xl text-4xl font-bold md:text-6xl">Réservez en quelques clics</h1>
                        <p class="mb-8 max-w-xl text-lg md:text-xl">Processus simple, rapide et entièrement sécurisé.</p>
                        <div class="flex flex-wrap justify-center gap-4">
                            <a href="{{ route('contact.index') }}" class="rounded-full bg-white px-6 py-3 font-semibold text-blue-600 shadow hover:bg-gray-100">Contactez‑nous</a>
                            <a href="{{ route('a-savoir') }}" class="rounded-full border border-white px-6 py-3 font-semibold text-white hover:bg-white hover:text-blue-600">En savoir plus</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Controls -->
            <div class="swiper-pagination !bottom-5"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </section>

    <!-- Splash vidéo publicitaire (optionnel) -->
    <div id="videoSplash" class="fixed inset-0 z-[60] hidden items-center justify-center bg-black/90">
        <div class="relative w-full max-w-3xl overflow-hidden rounded-lg shadow-lg">
            <video id="splashVideo" autoplay muted playsinline class="h-auto w-full">
                <source src="{{ asset('videos/pub.mp4') }}" type="video/mp4" />
                Votre navigateur ne supporte pas la vidéo.
            </video>
            <button id="skipBtn" class="absolute right-3 top-3 rounded bg-gray-800/70 px-4 py-1 text-white hover:bg-gray-900">❌</button>
        </div>
    </div>

    <!-- À propos -->
    <section class="py-20">
        <div class="container mx-auto px-4 text-center">
            <h2 class="mb-6 text-3xl font-extrabold text-blue-800 md:text-5xl">Trouvez votre logement étudiant facilement</h2>
            <p class="mx-auto max-w-3xl text-lg text-gray-700 md:text-xl">
                CampusHome est votre partenaire logement idéal. Explorez des offres vérifiées, réservez en quelques clics, échangez avec les propriétaires et payez en toute sécurité, le tout depuis un seul endroit.
            </p>

            <div class="mt-16 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <!-- Card 1 -->
                <div class="group rounded-xl bg-white p-6 shadow-md transition hover:-translate-y-1 hover:shadow-lg">
                    <img src="https://i.pinimg.com/736x/65/3f/a3/653fa38cd891a022ac5a50b61a343e06.jpg" alt="Flexibilité" class="mx-auto mb-4 h-28 w-28 rounded-full object-cover ring-4 ring-blue-100" />
                    <h3 class="mb-2 text-xl font-semibold text-blue-700 group-hover:underline">Flexibilité maximale</h3>
                    <p class="text-gray-600">Recherchez selon vos critères : proximité, type de logement, budget… vous choisissez.</p>
                </div>
                <!-- Card 2 -->
                <div class="group rounded-xl bg-white p-6 shadow-md transition hover:-translate-y-1 hover:shadow-lg">
                    <img src="https://i.pinimg.com/736x/4b/15/ec/4b15ecbb84bb2e1bd22f82cb7db303b7.jpg" alt="Sécurité" class="mx-auto mb-4 h-28 w-28 rounded-full object-cover ring-4 ring-blue-100" />
                    <h3 class="mb-2 text-xl font-semibold text-blue-700 group-hover:underline">Transactions sécurisées</h3>
                    <p class="text-gray-600">Réservations et paiements sont protégés pour garantir votre tranquillité.</p>
                </div>
                <!-- Card 3 -->
                <div class="group rounded-xl bg-white p-6 shadow-md transition hover:-translate-y-1 hover:shadow-lg">
                    <img src="https://i.pinimg.com/736x/e7/22/fd/e722fdbd0d5da4c6a6c09e0b8b915324.jpg" alt="Communauté" class="mx-auto mb-4 h-28 w-28 rounded-full object-cover ring-4 ring-blue-100" />
                    <h3 class="mb-2 text-xl font-semibold text-blue-700 group-hover:underline">Une vraie communauté</h3>
                    <p class="text-gray-600">Rejoignez des milliers d’étudiants et échangez avec des propriétaires de confiance.</p>
                </div>
                <!-- Card 4 -->
                <div class="group rounded-xl bg-white p-6 shadow-md transition hover:-translate-y-1 hover:shadow-lg">
                    <img src="https://i.pinimg.com/736x/47/72/d5/4772d5ae19f23190903c283af02f7b00.jpg" alt="Rapidité" class="mx-auto mb-4 h-28 w-28 rounded-full object-cover ring-4 ring-blue-100" />
                    <h3 class="mb-2 text-xl font-semibold text-blue-700 group-hover:underline">Réservation instantanée</h3>
                    <p class="text-gray-600">Dès que vous trouvez le bon logement, réservez immédiatement.</p>
                </div>
                <!-- Card 5 -->
                <div class="group rounded-xl bg-white p-6 shadow-md transition hover:-translate-y-1 hover:shadow-lg">
                    <img src="https://i.pinimg.com/736x/af/e0/0f/afe00fa33fc676706eee5c7e21c9ae89.jpg" alt="Suivi" class="mx-auto mb-4 h-28 w-28 rounded-full object-cover ring-4 ring-blue-100" />
                    <h3 class="mb-2 text-xl font-semibold text-blue-700 group-hover:underline">Tout sous contrôle</h3>
                    <p class="text-gray-600">Suivez vos réservations, paiements, avis et discussions dans votre tableau de bord.</p>
                </div>
                <!-- Card 6 -->
                <div class="group rounded-xl bg-white p-6 shadow-md transition hover:-translate-y-1 hover:shadow-lg">
                    <img src="https://i.pinimg.com/736x/37/f1/52/37f152f43481ed3f9ea23f2f7cb248a9.jpg" alt="Accessibilité" class="mx-auto mb-4 h-28 w-28 rounded-full object-cover ring-4 ring-blue-100" />
                    <h3 class="mb-2 text-xl font-semibold text-blue-700 group-hover:underline">Accessible partout</h3>
                    <p class="text-gray-600">Une plateforme responsive, disponible 24h/24 sur mobile ou ordinateur.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-blue-600 py-8 text-white">
        <div class="container mx-auto px-4 text-center">
            <p class="text-lg">&copy; 2025 — CampusHome. Tous droits réservés.</p>
        </div>
    </footer>

    <!-- JS : Swiper + Video splash -->
    <script>
        // Initialisation Swiper
        document.addEventListener('DOMContentLoaded', () => {
            new Swiper('.mySwiper', {
                effect: 'fade',
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        });

        // Vidéo splash (affichée max toutes les 5 min)
        document.addEventListener('DOMContentLoaded', () => {
            const splash = document.getElementById('videoSplash');
            const video = document.getElementById('splashVideo');
            const skipBtn = document.getElementById('skipBtn');
            const DELAI = 5 * 60 * 1000; // 5 minutes en ms

            function fermerSplash() {
                splash.classList.add('hidden');
                video.pause();
                localStorage.setItem('pubDerniereVue', Date.now());
            }

            function afficherSplash() {
                splash.classList.remove('hidden');
                video.currentTime = 0;
                video.play();
            }

            const derniereVue = localStorage.getItem('pubDerniereVue');
            if (!derniereVue || Date.now() - derniereVue > DELAI) {
                afficherSplash();
            }

            skipBtn.addEventListener('click', fermerSplash);
            video.addEventListener('ended', fermerSplash);
        });
    </script>
</body>
</html>



















{{-- <!DOCTYPE html>
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

    <!-- Video Splash Modal -->
    <div id="videoSplash" 
        class="fixed inset-0 bg-black bg-opacity-90 flex items-center justify-center z-50" style="display:none">
        
        <div class="relative w-full max-w-3xl mx-4 rounded-lg overflow-hidden shadow-lg">
            <video id="splashVideo" autoplay muted playsinline class="w-full h-auto" >
                <source src="{{ asset('videos/pub.mp4') }}" type="video/mp4" />
                Votre navigateur ne supporte pas la vidéo.
            </video>
            <!-- Bouton Skip -->
            <button id="skipBtn" 
                class="absolute top-3 right-3 bg-gray-800 bg-opacity-70 text-white px-4 py-1 rounded hover:bg-gray-900 transition">
                ❌
            </button>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const splash = document.getElementById('videoSplash');
        const video = document.getElementById('splashVideo');
        const skipBtn = document.getElementById('skipBtn');

        const DELAI_5_MIN = 1 * 60 * 1000; // 1 minutes en ms

        // Affiche la vidéo
        function afficherVideo() {
            splash.style.display = 'flex';
            video.currentTime = 0;
            video.play();

            // Quand on clique sur passer
            skipBtn.onclick = () => {
                video.pause();
                splash.style.display = 'none';
                localStorage.setItem('pubDerniereVue', Date.now());
            };

            // À la fin de la vidéo
            video.onended = () => {
                splash.style.display = 'none';
                localStorage.setItem('pubDerniereVue', Date.now());
            };
        }

        // Vérifie si on doit afficher la vidéo
        function verifierEtAfficher() {
            const derniereVue = localStorage.getItem('pubDerniereVue');
            const maintenant = Date.now();

            if (!derniereVue || (maintenant - derniereVue) > DELAI_5_MIN) {
                afficherVideo();
            }
        }

        verifierEtAfficher();

        // Répète la vérification toutes les minutes pour ne rien rater (on peut augmenter cet intervalle si besoin)
        setInterval(() => {
            verifierEtAfficher();
        }, 60 * 1000);
    });
    </script>


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
</html> --}}
