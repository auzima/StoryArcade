<?php

namespace App\Http\Controllers;

use App\Models\SaveGame;
use App\Http\Requests\SaveGameRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SaveGameController extends Controller
{
    use AuthorizesRequests;

    /**
     * Affiche la liste des sauvegardes de l'utilisateur.
     */
    public function index(): JsonResponse
    {
        $saveGames = SaveGame::with(['user', 'currentScene'])
            ->where('user_id', Auth::id())
            ->get();
        return response()->json($saveGames);
    }

    /**
     * Enregistre une nouvelle sauvegarde.
     */
    public function store(SaveGameRequest $request): JsonResponse
    {
        $saveGame = SaveGame::create($request->validated());
        return response()->json($saveGame, 201);
    }

    /**
     * Affiche une sauvegarde spécifique.
     */
    public function show(SaveGame $saveGame): JsonResponse
    {
        $this->authorize('view', $saveGame);
        $saveGame->load(['user', 'currentScene']);
        return response()->json($saveGame);
    }

    /**
     * Met à jour une sauvegarde spécifique.
     */
    public function update(SaveGameRequest $request, SaveGame $saveGame): JsonResponse
    {
        $this->authorize('update', $saveGame);
        $saveGame->update($request->validated());
        return response()->json($saveGame);
    }

    /**
     * Supprime une sauvegarde spécifique.
     */
    public function destroy(SaveGame $saveGame): JsonResponse
    {
        $this->authorize('delete', $saveGame);
        $saveGame->delete();
        return response()->json(null, 204);
    }
}
