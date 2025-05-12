<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\Admin\AuthController as AdminAuth;
use App\Http\Controllers\Proprietaire\DashboardController;
use App\Http\Controllers\Proprietaire\ReservationController;
use App\Http\Controllers\Proprietaire\LogementController;
use App\Http\Controllers\MessageController;


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

Route::get('/proprietaire/dashboard', [DashboardController::class, 'index'])->name('proprietaire.dashboard');