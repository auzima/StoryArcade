<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('games', GameController::class);

use App\Http\Controllers\GameController;
use App\Http\Controllers\SceneController;
use App\Http\Controllers\ChoiceController;


Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('scenes', SceneController::class);
    Route::resource('choices', ChoiceController::class);
});

use App\Http\Controllers\PlayController;

Route::get('/games', [GameController::class, 'index'])->name('games.index');

Route::get('/play/{game}/start', [PlayController::class, 'start'])->name('play.start');

Route::resource('games', GameController::class);



Route::get('/play', [PlayController::class, 'index'])->name('play.index');
Route::get('/play/{game}/start', [PlayController::class, 'start'])->name('play.start');
Route::get('/play/scene/{scene}', [PlayController::class, 'play'])->name('play.scene');