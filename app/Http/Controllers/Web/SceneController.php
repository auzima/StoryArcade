<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Scene\StoreSceneRequest;
use App\Http\Requests\Web\Scene\UpdateSceneRequest;
use App\Models\Game;
use App\Models\Scene;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class SceneController extends Controller
{
    /**
     * Affiche la liste des scènes d'un jeu
     */
    public function index(Game $game): View
    {
        $scenes = $game->scenes()
            ->withCount('choices')
            ->orderBy('order')
            ->get();
        return view('scenes.index', compact('game', 'scenes'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create(Game $game): View
    {
        return view('scenes.create', compact('game'));
    }

    /**
     * Enregistre une nouvelle scène
     */
    public function store(StoreSceneRequest $request, Game $game): RedirectResponse
    {
        $scene = $game->scenes()->create([
            ...$request->validated(),
            'order' => $game->scenes()->max('order') + 1,
        ]);

        return redirect()->route('games.scenes.index', $game)
            ->with('success', 'La scène a été créée avec succès.');
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(Scene $scene): View
    {
        $scene->load(['game', 'choices' => function ($query) {
            $query->orderBy('order');
        }]);
        return view('scenes.edit', compact('scene'));
    }

    /**
     * Met à jour une scène
     */
    public function update(UpdateSceneRequest $request, Scene $scene): RedirectResponse
    {
        $scene->update($request->validated());

        return redirect()->route('games.scenes.index', $scene->game)
            ->with('success', 'La scène a été mise à jour avec succès.');
    }

    /**
     * Supprime une scène
     */
    public function destroy(Scene $scene): RedirectResponse
    {
        $game = $scene->game;
        $scene->delete();

        // Réordonner les scènes restantes
        $game->scenes()
            ->where('order', '>', $scene->order)
            ->decrement('order');

        return redirect()->route('games.scenes.index', $game)
            ->with('success', 'La scène a été supprimée avec succès.');
    }
}
