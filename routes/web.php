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
use App\Http\Controllers\Proprietaire\AvisController;






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


// Routes pour l'étudiant
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [EtudiantDashboardController::class, 'index'])->middleware('auth')->name('dashboard');
    Route::get('/logements', [EtudiantLogementController::class, 'index'])->name('etudiant.logements.index');
    Route::get('/logements/{logement}', [EtudiantLogementController::class, 'show'])->name('etudiant.logements.show');


    Route::post('/logements/{logement}/reserver', [EtudiantReservationController::class, 'store'])->name('etudiant.reserver');
    Route::get('/mes-reservations', [EtudiantReservationController::class, 'index'])->name('etudiant.reservations.index');
    Route::get('/reservations/{reservation}/contrat', [EtudiantReservationController::class, 'contrat'])->name('etudiant.reservations.contrat');

});
Route::post('/reservations/{logement}', [App\Http\Controllers\Etudiant\ReservationController::class, 'store'])
    ->name('etudiant.reservations.store')
    ->middleware(['auth']); // S'assurer que l'étudiant est connecté


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

// Route pour la soumission d'un avis
Route::post('avis/{reservation_id}', [AvisController::class, 'store'])->name('avis.store');
// Route pour vérifier un avis
Route::post('proprietaire/avis/{id}/verifier', [Proprietaire\DashboardController::class, 'verifierAvis'])->name('proprietaire.avis.verifier');
// Route pour supprimer un avis
Route::get('/proprietaire/avis', [AvisController::class, 'index'])->name('proprietaire.avis.index');