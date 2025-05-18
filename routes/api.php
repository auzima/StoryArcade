<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\GameController;
use App\Http\Controllers\Api\V1\SceneController;
use App\Http\Controllers\Api\V1\ChoiceController;
use App\Http\Controllers\Api\V1\PlayController;
use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Scene;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->group(function () {
    // Routes publiques pour jouer
    Route::get('/games', [GameController::class, 'index'])->name('api.games.index');
    Route::get('/games/{game}', [GameController::class, 'show'])->name('api.games.show');
    Route::get('/play/{game}/start', [PlayController::class, 'start'])->name('api.play.start');
    Route::get('/play/scene/{scene}', [PlayController::class, 'scene'])->name('api.play.scene');

    // Routes protégées par authentification
    Route::middleware('auth:sanctum')->group(function () {
        // Gestion complète des jeux (CRUD)
        Route::apiResource('games', GameController::class)->except(['index', 'show']);
        Route::post('/games/{game}/publish', [GameController::class, 'publish'])->name('api.games.publish');
        Route::post('/games/{game}/unpublish', [GameController::class, 'unpublish'])->name('api.games.unpublish');

        // Gestion des scènes
        Route::apiResource('games.scenes', SceneController::class)->shallow();
        Route::post('/scenes/{scene}/reorder', [SceneController::class, 'reorder'])->name('api.scenes.reorder');

        // Gestion des choix
        Route::apiResource('scenes.choices', ChoiceController::class)->shallow();
    });
});
// Routes protégées par authentification
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
