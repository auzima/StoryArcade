<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\SceneController;
use App\Http\Controllers\ChoiceController;
use App\Http\Controllers\PlayController;
use App\Http\Controllers\DashboardController;

// Authentification
require __DIR__.'/auth.php';

// Page d'accueil
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (authentifié uniquement)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// Profil utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Gestion des jeux (CRUD accessible à tous les utilisateurs connectés)
Route::resource('games', GameController::class);

// Gestion des scènes et des choix (réservé admin)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/games/{game}/scenes', [SceneController::class, 'index'])->name('games.scenes.index');
    Route::resource('scenes', SceneController::class);
    Route::resource('choices', ChoiceController::class);
});

// Routes pour jouer
Route::get('/play', [PlayController::class, 'index'])->name('play.index');
Route::get('/play/{game}/start', [PlayController::class, 'start'])->name('play.start');
Route::get('/play/scene/{scene}', [PlayController::class, 'play'])->name('play.scene');