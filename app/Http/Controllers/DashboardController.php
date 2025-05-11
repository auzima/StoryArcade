<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
 // DashboardController.php
public function index()
{
    $games = \App\Models\Game::with('scenes')->get();
    return view('dashboard', compact('games'));
}


}