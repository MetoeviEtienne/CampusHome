@extends('layouts.proAd')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-white via-blue-50 to-white py-12 px-4 sm:px-6 lg:px-20">
    <div class="max-w-6xl mx-auto">
        {{-- Titre principal --}}
        <div class="text-center mb-12">
            <h1 class="text-4xl lg:text-5xl font-extrabold text-blue-600">📘 Tout savoir sur CampusHome</h1>
            <p class="text-gray-600 text-lg mt-4 max-w-2xl mx-auto">Un guide complet pour comprendre le fonctionnement de notre plateforme selon votre rôle.</p>
        </div>

        {{-- Introduction --}}
        <div class="bg-white shadow-md rounded-xl p-6 lg:p-10 mb-10">
            <p class="text-gray-700 text-lg leading-relaxed">
                Bienvenue sur <span class="font-bold text-blue-600">CampusHome</span>, la plateforme de <strong>gestion simplifiée des logements étudiants</strong>. Elle offre un espace sécurisé et efficace pour :
                <span class="text-blue-600 font-semibold">les étudiants</span>,
                <span class="text-blue-600 font-semibold">les propriétaires</span> et
                <span class="text-blue-600 font-semibold">l’administration</span>.
            </p>
        </div>

        {{-- Bloc Étudiants --}}
        <div class="mb-12">
            <h2 class="text-3xl font-semibold text-blue-500 flex items-center mb-6">
                <span class="mr-2">👨‍🎓</span> Étudiants
            </h2>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-blue-100">
                <ol class="list-decimal space-y-4 pl-6 text-gray-800 leading-relaxed">
                    <li><strong>Inscription / Connexion :</strong> Création de compte avec informations personnelles.</li>
                    <li><strong>Recherche de logement :</strong> Recherche par ville, type, prix, etc.</li>
                    <li><strong>Réservation :</strong> Réservation simple avec notifications envoyées.</li>
                    <li><strong>Paiement :</strong> 
                        <ul class="list-disc pl-6 mt-1">
                            <li>Avance (loyer × 3.5)</li>
                            <li>Paiement mensuel</li>
                        </ul>
                        Moyens : <span class="font-bold">MTN MoMo</span> & <span class="font-bold">Kkiapay</span>.
                    </li>
                    <li><strong>Réception d’un reçu :</strong> PDF généré automatiquement et envoyé par mail.</li>
                    <li><strong>Maintenance :</strong> Déclaration de problème en quelques clics.</li>
                </ol>
            </div>
        </div>

        {{-- Bloc Propriétaires --}}
        <div class="mb-12">
            <h2 class="text-3xl font-semibold text-blue-500 flex items-center mb-6">
                <span class="mr-2">🏠</span> Propriétaires
            </h2>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-blue-100">
                <ol class="list-decimal space-y-4 pl-6 text-gray-800 leading-relaxed">
                    <li><strong>Inscription / Connexion :</strong> Création de compte propriétaire.</li>
                    <li><strong>Ajout de logements :</strong> Avec détails, photos, loyers, etc.</li>
                    <li><strong>Validation par l’administration :</strong> Avant publication des logements.</li>
                    <li><strong>Réservations :</strong> Notification lors d’une réservation.</li>
                    <li><strong>Paiements :</strong> Visualisation des paiements et détails des locataires.</li>
                    <li><strong>Transfert automatique :</strong> Reçu de sa part du paiement.</li>
                    <li><strong>Maintenance :</strong> Réception des demandes des étudiants.</li>
                </ol>
            </div>
        </div>

        {{-- Bloc Administration --}}
        <div class="mb-12">
            <h2 class="text-3xl font-semibold text-blue-500 flex items-center mb-6">
                <span class="mr-2">🛠️</span> Administration
            </h2>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-blue-100">
                <ol class="list-decimal space-y-4 pl-6 text-gray-800 leading-relaxed">
                    <li><strong>Validation des logements :</strong> Acceptation ou rejet des logements.</li>
                    <li><strong>Suivi des réservations :</strong> Vue d’ensemble de toutes les opérations.</li>
                    <li><strong>Gestion des messages :</strong> Via le formulaire de contact.</li>
                    <li><strong>Supervision des paiements :</strong> 15% sur les avances + contrôle complet.</li>
                    <li><strong>Gestion des litiges :</strong> Médiation entre utilisateurs en cas de problème.</li>
                </ol>
            </div>
        </div>

        {{-- Sécurité et transparence --}}
        <div class="bg-blue-100 border-l-4 border-blue-500 p-6 rounded-xl shadow-inner mb-12">
            <p class="text-blue-800 text-lg font-semibold">
                🔐 La sécurité et la transparence sont les piliers de CampusHome : toutes les opérations sont surveillées et les utilisateurs vérifiés.
            </p>
        </div>

        {{-- Bouton de retour --}}
        <div class="text-center">
            <a href="{{ url('/') }}" class="inline-flex items-center justify-center bg-blue-600 text-white px-6 py-3 rounded-lg text-lg font-semibold hover:bg-blue-700 transition duration-300">
                ← Retour à l'accueil
            </a>
        </div>
    </div>
</div>
@endsection
