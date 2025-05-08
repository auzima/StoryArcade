<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Http\Requests\GameRequest;
use Illuminate\Http\JsonResponse;

class GameController extends Controller
{
    /**
     * Affiche la liste des jeux.
     */
    public function index(): JsonResponse
    {
        $games = Game::with(['user', 'startScene'])->get();
        return response()->json($games);
    }

    /**
     * Enregistre un nouveau jeu.
     */
    public function store(GameRequest $request): JsonResponse
    {
        $game = Game::create($request->validated());
        return response()->json($game, 201);
    }

    /**
     * Affiche un jeu spécifique.
     */
    public function show(Game $game): JsonResponse
    {
        $game->load(['user', 'startScene', 'scenes']);
        return response()->json($game);
    }

    /**
     * Met à jour un jeu spécifique.
     */
    public function update(GameRequest $request, Game $game): JsonResponse
    {
        $game->update($request->validated());
        return response()->json($game);
    }

    /**
     * Supprime un jeu spécifique.
     */
    public function destroy(Game $game): JsonResponse
    {
        $game->delete();
        return response()->json(null, 204);
    }
}
