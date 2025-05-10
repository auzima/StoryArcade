<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;

class GameController extends Controller
{
    /**
     * Affiche tous les jeux (liste)
     */
    public function index()
    {
        $games = Game::all();
        return view('games.index', compact('games'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        return view('games.create');
    }

    /**
     * Enregistre un nouveau jeu
     */
    public function store(StoreGameRequest $request)
    {
        Game::create([
            ...$request->validated(),
            'author' => 'Invité',
        ]);
    
        return redirect()->route('games.index')->with('success', 'Jeu créé avec succès !');
    }

    /**
     * Affiche un jeu en particulier
     */
    public function show(Game $game)
    {
        $game->load('scenes');
        return view('games.show', compact('game'));
    }
    /**
     * Affiche le formulaire de modification
     */
    public function edit(Game $game)
    {
        return view('games.edit', compact('game'));
    }

    /**
     * Met à jour les données d’un jeu
     */
    public function update(UpdateGameRequest $request, Game $game)
    {
        $game->update($request->validated());
        return redirect()->route('games.index')->with('success', 'Jeu mis à jour avec succès !');
    }

    /**
     * Supprime un jeu
     */
    public function destroy(Game $game)
    {
        $game->delete();
        return redirect()->route('games.index')->with('success', 'Jeu supprimé.');
    }
}