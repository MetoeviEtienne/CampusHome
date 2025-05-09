<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\Admin\AuthController as AdminAuth;

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
// Routes pour l'authentification des administrateurs
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminAuth::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuth::class, 'login'])->name('admin.login.submit');
    Route::get('/dashboard', [AdminAuth::class, 'dashboard'])->middleware('auth:admin')->name('admin.dashboard');
    Route::get('/logout', [AdminAuth::class, 'logout'])->name('admin.logout');
});
