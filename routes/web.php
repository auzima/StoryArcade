<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\SceneController;
use App\Http\Controllers\ChoiceController;
use App\Http\Controllers\PlayController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;

// Authentification (fortement recommandé de garder au début)
require __DIR__ . '/auth.php';

// Page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// Dashboard (admin seulement)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// Profil utilisateur (authentifié)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes publiques pour les jeux
Route::get('/games', [GameController::class, 'index'])->name('games.index');
Route::get('/play', [PlayController::class, 'index'])->name('play.index');
Route::get('/play/{game}/start', [PlayController::class, 'start'])->name('play.start');
Route::get('/play/scene/{scene}', [PlayController::class, 'play'])->name('play.scene');

// Routes pour CRUD des jeux (authentification requise)
Route::middleware('auth')->group(function () {
    Route::resource('games', GameController::class)->except(['index']);
});

// Routes réservées aux administrateurs (gestion scènes et choix)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/games/{game}/scenes', [SceneController::class, 'index'])->name('games.scenes.index');
    Route::get('/games/{game}/scenes/create', [SceneController::class, 'create'])->name('games.scenes.create');
    Route::post('/scenes', [SceneController::class, 'store'])->name('scenes.store');
    Route::get('/scenes/{scene}/edit', [SceneController::class, 'edit'])->name('scenes.edit');
    Route::put('/scenes/{scene}', [SceneController::class, 'update'])->name('scenes.update');
    Route::delete('/scenes/{scene}', [SceneController::class, 'destroy'])->name('scenes.destroy');

    Route::resource('choices', ChoiceController::class);
});
