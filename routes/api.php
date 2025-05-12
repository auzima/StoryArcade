<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\GameController;
use App\Http\Controllers\Api\V1\SceneController;
use App\Http\Controllers\Api\V1\ChoiceController;
use App\Http\Controllers\Api\V1\PlayController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->group(function () {
  // Routes publiques
  Route::get('/games', [GameController::class, 'index'])->name('api.games.index');
  Route::get('/games/{game}', [GameController::class, 'show'])->name('api.games.show');

  // Routes pour le jeu
  Route::prefix('play')->group(function () {
    Route::get('/{game}/start', [PlayController::class, 'start']);
    Route::get('/scene/{scene}', [PlayController::class, 'scene']);
    Route::post('/scene/{scene}/choice', [PlayController::class, 'makeChoice']);
  });

  // Routes protégées par authentification
  Route::middleware('auth:sanctum')->group(function () {
    // Gestion des jeux
    Route::apiResource('games', GameController::class)->except(['index', 'show']);

    // Gestion des scènes
    Route::apiResource('scenes', SceneController::class);

    // Gestion des choix
    Route::apiResource('choices', ChoiceController::class);
  });
});
