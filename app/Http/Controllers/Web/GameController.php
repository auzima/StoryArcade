<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Game\StoreGameRequest;
use App\Http\Requests\Web\Game\UpdateGameRequest;
use App\Models\Game;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class GameController extends Controller
{
    /**
     * Affiche la liste des jeux pour les administrateurs
     */
    public function index(): View
    {
        $games = Game::with(['scenes', 'choices'])
            ->withCount(['scenes', 'choices'])
            ->get();
        return view('games.admin.index', compact('games'));
    }

    /**
     * Affiche la liste des jeux publiés pour les visiteurs
     */
    public function public(): View
    {
        $games = Game::with(['scenes'])
            ->where('is_published', true)
            ->withCount(['scenes', 'choices'])
            ->get();

        return view('games.public.index', compact('games'));
    }

    /**
     * Affiche le jeu pour les joueurs
     */
    public function play(Game $game): View
    {
        if (!$game->is_published) {
            abort(404);
        }

        $game->load(['scenes' => function ($query) {
            $query->orderBy('order');
        }, 'scenes.choices' => function ($query) {
            $query->orderBy('order');
        }]);

        return view('layouts.app', [
            'game' => $game,
            'initialData' => [
                'game' => $game->toArray()
            ]
        ]);
    }

    /**
     * Affiche le formulaire de création
     */
    public function create(): View
    {
        return view('games.admin.create');
    }

    /**
     * Enregistre un nouveau jeu
     */
    public function store(StoreGameRequest $request): RedirectResponse
    {
        $game = Game::create([
            ...$request->validated(),
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('games.show', $game)
            ->with('success', 'Le jeu a été créé avec succès.');
    }

    /**
     * Affiche un jeu spécifique
     */
    public function show(Game $game): View
    {
        $game->load(['scenes' => function ($query) {
            $query->orderBy('order');
        }, 'scenes.choices' => function ($query) {
            $query->orderBy('order');
        }]);

        return view('games.admin.show', compact('game'));
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(Game $game): View
    {
        return view('games.admin.edit', compact('game'));
    }

    /**
     * Met à jour un jeu
     */
    public function update(UpdateGameRequest $request, Game $game): RedirectResponse
    {
        $game->update($request->validated());

        return redirect()->route('games.show', $game)
            ->with('success', 'Le jeu a été mis à jour avec succès.');
    }

    /**
     * Supprime un jeu
     */
    public function destroy(Game $game): RedirectResponse
    {
        $game->delete();

        return redirect()->route('games.index')
            ->with('success', 'Le jeu a été supprimé avec succès.');
    }
}
