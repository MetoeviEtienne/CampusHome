<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\Admin\AuthController as AdminAuth;
use App\Http\Controllers\Proprietaire\DashboardController;
use App\Http\Controllers\Proprietaire\ReservationController;
use App\Http\Controllers\Proprietaire\LogementController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Etudiant\LogementController as EtudiantLogementController;
use App\Http\Controllers\Etudiant\ReservationController as EtudiantReservationController;
use App\Http\Controllers\Etudiant\DashboardController as EtudiantDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ValidationLogementController;
use App\Http\Controllers\Proprietaire\AvisController as ProprietaireAvisController;
use App\Http\Controllers\AvisController as EtudiantAvisController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Proprietaire\NotificationController;
use App\Http\Controllers\Etudiant\MaintenanceEtudiantController;
use App\Http\Controllers\Etudiant\ColocationController;
use App\Http\Controllers\AvisEtoileController;


Route::get('/', function () {
    return view('campushome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


 // Routes protégées par rôle
Route::middleware(['auth', 'verified'])->group(function () {
     // Tableau de bord étudiant
     Route::get('/dashboard', function () {
         return view('dashboard');
     // })->name('dashboard')->middleware('role:student');
     })->name('dashboard');

     // Tableau de bord propriétaire
Route::get('/proprietaire/dashboard', function () {
         return view('proprietaire.dashboard');
     })->name('proprietaire.dashboard');
});


// Route pour le tableau de bord du propriétaire
Route::get('/proprietaire/dashboard', [DashboardController::class, 'index'])->name('proprietaire.dashboard');




// Routes pour l'authentification des administrateurs
// Route::get('/admin', [AdminAuth::class, 'showLoginForm'])->name('admin.login');
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminAuth::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuth::class, 'login'])->name('admin.login.submit');
    Route::get('/register', [AdminAuth::class, 'showRegisterForm'])->name('admin.register');
    Route::post('/register', [AdminAuth::class, 'register'])->name('admin.register.submit');
    Route::get('/dashboard', [AdminAuth::class, 'dashboard'])->middleware('auth:admin')->name('admin.dashboard');
    Route::get('/logout', [AdminAuth::class, 'logout'])->name('admin.logout');
});


// Route::get('/proprietaire/dashboard', [DashboardController::class, 'index'])->name('proprietaire.dashboard');

Route::prefix('/proprietaire/logements')->group(function () {
    Route::get('/', [LogementController::class, 'index'])->name('proprietaire.logements.index');
    Route::get('/creer', [LogementController::class, 'create'])->name('proprietaire.logements.create');
    Route::post('/', [LogementController::class, 'store'])->name('proprietaire.logements.store');

    // Route pour afficher le formulaire d'édition
    Route::get('/{logement}/modifier', [LogementController::class, 'edit'])->name('proprietaire.logements.edit');
    
    // Route pour mettre à jour le logement
    Route::put('/{logement}', [LogementController::class, 'update'])->name('proprietaire.logements.update');
     
    // Route pour supprimer le logement
    Route::delete('/{logement}', [LogementController::class, 'destroy'])->name('proprietaire.logements.destroy');
});

// Routes pour la gestion des réservations
Route::get('/proprietaire/reservations', [ReservationController::class, 'index'])->name('proprietaire.reservations.index');
Route::post('/proprietaire/reservations/{reservation}/approver', [ReservationController::class, 'approver'])->name('proprietaire.reservations.approve');
Route::post('/proprietaire/reservations/{reservation}/rejeter', [ReservationController::class, 'rejeter'])->name('proprietaire.reservations.reject');

// Route::get('/proprietaire/reservations/{reservation}/contrat', [ReservationController::class, 'generateContract'])->name('proprietaire.reservations.contract');



// Routes pour la gestion des messages
Route::middleware(['auth'])->prefix('proprietaire')->group(function() {
    Route::get('/messages', [MessageController::class, 'index'])->name('proprietaire.messages'); // Afficher les messages
    Route::post('/messages', [MessageController::class, 'store'])->name('proprietaire.messages.store'); // Envoyer un message
});

Route::get('/etudiant/logements/{logement}/reservation', [ReservationController::class, 'create'])
    ->name('etudiant.reservations.create')
    ->middleware('auth:etudiant');

// Routes pour l'étudiant
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [EtudiantDashboardController::class, 'index'])->middleware('auth')->name('dashboard');
    Route::get('/logements', [EtudiantLogementController::class, 'index'])->name('etudiant.logements.index');
    // Route::get('/logements/{logement}', [EtudiantLogementController::class, 'show'])->name('etudiant.logements.show');
    
    Route::get('/proprietaire/messages', [MessageController::class, 'proprietaireIndex'])->name('proprietaire.messages');
    Route::get('/etudiant/messages', [MessageController::class, 'etudiantIndex'])->name('etudiants.messages');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
    
    // Route::get('/etudiant/logements/{logement}', [EtudiantLogementController::class, 'show'])->name('etudiant.logements.show');
    // Route::post('/logements/{logement}/reserver', [EtudiantReservationController::class, 'store'])->name('etudiant.reserver');
    // Route::post('/logements/{logement}/reserver', [EtudiantReservationController::class, 'store'])->name('reservations.store');

    Route::post('/logements/reservations/{logement}', [EtudiantReservationController::class, 'store'])->name('etudiants.reservations.store');
    Route::get('/mes-reservations', [EtudiantReservationController::class, 'index'])->name('etudiant.reservations.index');
    Route::get('/reservations/{reservation}/contrat', [EtudiantReservationController::class, 'contrat'])->name('etudiant.reservations.contrat');
    Route::get('/reservations/{logement}/create', [EtudiantReservationController::class, 'create'])->name('etudiant.reservations.create');
});
// Route pour la messagerie entre le propriétaire et l'étudiant
Route::get('/etudiant/messages/{proprietaireId}', [MessageController::class, 'conversation'])->name('etudiants.messages.conversation');
Route::get('/proprietaire/messages/{etudiantId}', [MessageController::class, 'conversationEtudiant'])->name('proprietaire.messages.conversation');

//Déconnexion
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
     ->name('logout');

     //Notifications
Route::get('/notification/{id}/lire', function ($id) {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();
    
        return redirect()->back();
        })->name('notifications.lire');

// Route pour marquer toutes les demandes de maintenance comme lues      
Route::prefix('proprietaire')->middleware('auth')->group(function () {
     Route::get('/maintenances', [\App\Http\Controllers\Proprietaire\MaintenancesController::class, 'index'])->name('proprietaire.maintenances.index');
    Route::patch('/maintenances/{maintenance}', [\App\Http\Controllers\Proprietaire\MaintenancesController::class, 'updateStatus'])->name('proprietaire.maintenances.update');
    });
  
//Route pour marquer toutes les notifications comme lues
Route::get('/proprietaire/notifications', [App\Http\Controllers\Proprietaire\NotificationController::class, 'index'])->name('proprietaire.notifications.index');
Route::get('/proprietaire/notifications/lire/{id}', [App\Http\Controllers\Proprietaire\NotificationController::class, 'lire'])->name('notifications.lire');

// // Route pour la soumission d'un avis
// Route::post('avis/{reservation_id}', [AvisController::class, 'store'])->name('avis.store');
// // Route pour vérifier un avis
// Route::post('proprietaire/avis/{id}/verifier', [Proprietaire\DashboardController::class, 'verifierAvis'])->name('proprietaire.avis.verifier');
// // Route pour supprimer un avis
// Route::get('/proprietaire/avis', [AvisController::class, 'index'])->name('proprietaire.avis.index');


// Gestion des utilisateurs par l'administrateur
Route::prefix('admin')->group(function () {
    Route::get('/utilisateurs', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/utilisateurs/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/utilisateurs/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/utilisateurs/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

// Route pour la gestion des administrateurs
Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('/admins', [AdminController::class, 'index'])->name('admin.admins.index');
    Route::get('/admins/create', [AdminController::class, 'create'])->name('admin.admins.create');
    Route::post('/admins', [AdminController::class, 'store'])->name('admin.admins.store');
    Route::get('/admins/{admin}/edit', [AdminController::class, 'edit'])->name('admin.admins.edit');
    Route::put('/admins/{admin}', [AdminController::class, 'update'])->name('admin.admins.update');
    Route::delete('/admins/{admin}', [AdminController::class, 'destroy'])->name('admin.admins.destroy');
});

// Route pour la gestion des logements à valider
Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('/logements-a-valider', [ValidationLogementController::class, 'index'])->name('admin.logements.index');
    Route::post('/logements/{logement}/valider', [ValidationLogementController::class, 'valider'])->name('admin.logements.valider');
    // Route pour rejeter un logement
    Route::post('/logements/{logement}/rejeter', [ValidationLogementController::class, 'rejeter'])->name('admin.logements.rejecter');
});

// Route pour afficher l'historique des logements validés
Route::get('/admin/logements/historique', [ValidationLogementController::class, 'historique'])->name('admin.logements.historique');

// Routes pour la gestion des maintenances
// Route pour afficher la liste des demandes de maintenance
// Route pour mettre à jour le statut d'une demande de maintenance
Route::prefix('admin')->name('admin.')->middleware(['auth:admin'])->group(function () {
    Route::get('maintenances', [\App\Http\Controllers\Admin\MaintenanceController::class, 'index'])->name('maintenances.index');
    Route::patch('maintenances/{maintenance}', [\App\Http\Controllers\Admin\MaintenanceController::class, 'updateStatus'])->name('maintenances.update');
});

// Route pour afficher les avis
// Route pour vérifier un avis
// Route pour supprimer un avis
Route::prefix('admin')->name('admin.')->middleware(['auth:admin'])->group(function () {
    Route::get('avis', [\App\Http\Controllers\Admin\AvisController::class, 'index'])->name('avis.index');
    Route::patch('avis/{avis}/verifier', [\App\Http\Controllers\Admin\AvisController::class, 'verifier'])->name('avis.verifier');
});

// Routes pour les propriétaires
Route::prefix('proprietaire')->name('proprietaire.')->group(function () {
    Route::get('/avis', [ProprietaireAvisController::class, 'index'])->name('avis.index');
    // autres routes propriétaire
});

// Routes pour les étudiants
Route::prefix('etudiant')->name('etudiant.')->group(function () {
    Route::get('/logements/{logement}/avis', [EtudiantAvisController::class, 'showForm'])->name('logements.avis');
    Route::post('/logements/{logement}/avis', [EtudiantAvisController::class, 'store'])->name('logements.avis.store');
    // autres routes étudiant
});

// Route pour afficher le detail d'un logement
Route::get('/etudiant/logements/{logement}', [LogementController::class, 'show'])->name('etudiant.logements.show');

// Route pour supprimer une réservation par l'étudiant
Route::delete('/etudiant/reservations/{reservation}', [\App\Http\Controllers\Etudiant\ReservationController::class, 'destroy'])
    ->name('etudiant.reservations.destroy');

    // Route pour supprimer une réservation par le propriétaire
Route::delete('/proprietaire/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('proprietaire.reservations.destroy');

// Route pour le paiement par Mobile Money
// Route::post('/paiement/momo', [PaiementController::class, 'payer']);

Route::post('/paiement/momo', [PaiementController::class, 'payer'])->name('paiement.momo');
Route::post('/paiement/momo/callback', [PaiementController::class, 'callback'])->name('paiement.momo.callback');

// Route pour le formulaire de contact
 Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
 Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');



// Routes pour la réinitialisation du mot de passe
Route::middleware('guest')->group(function () {
    // Formulaire demande lien réinitialisation
    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    // Envoi mail avec lien réinitialisation
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    // Formulaire pour saisir le nouveau mot de passe (avec token)
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    // Validation et mise à jour du nouveau mot de passe
    Route::post('/reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});


// Routes pour la vérification de l'email
Route::middleware('auth')->group(function () {
    // Page de demande de vérification
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    // Lien dans l'email qui vérifie l'utilisateur
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('/dashboard');
    })->middleware(['signed'])->name('verification.verify');

    // Renvoyer un nouveau lien
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    })->middleware(['throttle:6,1'])->name('verification.send');
});

// Route pour la notification pour le proprietaire
Route::prefix('proprietaire/notifications')->middleware('auth')->group(function () {
    Route::get('/', [NotificationController::class, 'index'])->name('proprietaire.notifications.index');
    Route::get('/{id}/lire', [NotificationController::class, 'lire'])->name('notifications.lire');
    Route::post('/toutes-lues', [NotificationController::class, 'toutesLues'])->name('notifications.toutes.lues');
});


//Route pour le paiement
Route::post('/paiement/momo', [PaiementController::class, 'initierPaiement'])->name('paiement.momo');
Route::get('/paiement/callback', [PaiementController::class, 'callback'])->name('paiement.callback');

// Route pour telecharger le reçu de paiement
Route::get('/paiements/{paiement}/recu', [PaiementController::class, 'telechargerRecu'])
    ->name('paiement.recu')
    ->middleware('auth');

// Route pour la demande de la maintenance
Route::middleware(['auth'])->group(function () {
    Route::get('/etudiants/maintenance/{logement}/create', [MaintenanceEtudiantController::class, 'create'])->name('etudiants.maintenance.create');
    Route::post('/etudiants/maintenance/{logement}', [MaintenanceEtudiantController::class, 'store'])->name('etudiants.maintenance.store');
});

//Route pour les annonces de recherche de colocataire
Route::middleware(['auth'])->prefix('colocations')->group(function () {
    Route::get('/create/{reservation}', [ColocationController::class, 'create'])->name('colocations.create');
    Route::post('/store/{reservation}', [ColocationController::class, 'store'])->name('colocations.store');
});
Route::get('/colocations', [ColocationController::class, 'index'])->name('colocations.index');

// Routes pour les avis étoiles
Route::post('/etudiant/logements/{logement}/noter', [AvisEtoileController::class, 'noter'])->name('etudiant.logements.notes.store');

// route pour la suppression de l'annonce de colocation
Route::delete('/etudiant/colocations/{id}', [ColocationController::class, 'destroy'])->name('etudiant.colocations.destroy');




// Routes pour la gestion des réservations par l'administrateur
Route::prefix('admin')->middleware(['auth:admin'])->name('admin.')->group(function () {
    Route::get('/reservations', [\App\Http\Controllers\Admin\ReservationController::class, 'index'])->name('reservations.index');
    Route::post('/reservations/{reservation}/approve', [\App\Http\Controllers\Admin\ReservationController::class, 'approver'])->name('reservations.approve');
    Route::post('/reservations/{reservation}/reject', [\App\Http\Controllers\Admin\ReservationController::class, 'rejeter'])->name('reservations.reject');
    Route::delete('/reservations/{reservation}', [\App\Http\Controllers\Admin\ReservationController::class, 'destroy'])->name('reservations.destroy');
});

// // Routes pour gestion des reservations par le pro
// Route::post('/reservations/{reservation}/approve', [\App\Http\Controllers\Shared\ReservationSyncController::class, 'approveFromProprietaire'])->name('proprietaire.reservations.approve');
// Route::post('/reservations/{reservation}/reject', [\App\Http\Controllers\Shared\ReservationSyncController::class, 'rejectFromProprietaire'])->name('proprietaire.reservations.reject');


// Routes pour voir les paiements par l'administrateur
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('paiements', [PaiementController::class, 'index'])->name('paiements.index');
});

// Route pour trier les proprietaire
Route::get('/proprietaire/paiements', [PaiementController::class, 'indexParProprietaire'])->name('proprietaire.paiements');

// Route pour supprimer un paiement au niveau de l'administrateur
Route::delete('/admin/paiements/{paiement}', [PaiementController::class, 'destroy'])->name('admin.paiements.destroy');

// routes pour la gestion des contrats par l'administrateur
Route::get('/admin/contrats', [App\Http\Controllers\Admin\ContratController::class, 'index'])->name('admin.contrats.index');

// Route pour afficher les contacts
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Autres routes...
    Route::get('admin/contacts', [App\Http\Controllers\Admin\ContactController::class, 'index'])->name('contact.index');
    
});
Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');

// Route pour la documentation de la plateforme 
Route::get('/a-savoir', [App\Http\Controllers\PageController::class, 'aSavoir'])->name('a-savoir');
