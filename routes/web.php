<?php

use Illuminate\Support\Facades\Route;

// Route principale pour l'application Vue.js
Route::get('/{any}', function () {
    return view('layouts.app');
})->where('any', '.*');
