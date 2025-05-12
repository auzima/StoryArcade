<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\GameController;

Route::prefix('api/v1/')->group(function () {
  Route::get('/test', function () {
    return response()->json(['message' => 'Hello, World from api!']);
  });

  Route::delete('/test', function () {
    return response()->json(['message' => 'Deleting']);
  });

  Route::post('/time', function () {
    $timeClient = request()->input('timeClient', 0);
    sleep(2); // Simulate a long-running process
    return response()->json(['timeClient' => $timeClient, 'timeServer' => now()]);
  });

  Route::get('/games', [GameController::class, 'index']);
});
