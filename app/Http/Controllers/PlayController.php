<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Scene;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PlayController extends Controller
{
    public function index(): View
    {
        // Charge chaque jeu avec uniquement sa première scène
        $games = Game::with(['scenes' => function ($query) {
            $query->orderBy('id')->limit(1);
        }])->get();

        return view('play.index', compact('games'));
    }

    public function start(Game $game): RedirectResponse
    {
        $firstScene = $game->scenes()->first();

        if (!$firstScene) {
            return redirect()->route('play.index')->with('error', 'Ce jeu ne contient pas encore de scène.');
        }

        return redirect()->route('play.scene', $firstScene);
    }

    public function play(Scene $scene): View
    {
        $scene->load('choices'); // charge les choix liés à la scène
        return view('play.scene', compact('scene'));
    }
}