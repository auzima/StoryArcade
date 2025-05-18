<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Resources\GameResource;
use App\Http\Resources\GameCollection;

class GameController extends Controller
{
    /**
     * Récupère la liste des jeux disponibles
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $games = Game::with(['scenes', 'user'])
            ->where('is_published', true)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $games->map(function ($game) {
                return [
                    'id' => $game->id,
                    'title' => $game->title,
                    'description' => $game->description,
                    'version' => $game->version,
                    'cover_image' => $game->scenes->first()?->image ? asset('storage/' . $game->scenes->first()->image) : null,
                ];
            })
        ]);
    }

    /**
     * Récupère un jeu spécifique
     *
     * @param Game $game
     * @return JsonResponse
     */
    public function show(Game $game): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => new GameResource($game->load(['scenes', 'user']))
        ]);
    }

    public function published(): JsonResponse
    {
        $games = Game::where('is_published', true)
            ->with(['scenes' => function ($query) {
                $query->orderBy('order');
            }])
            ->get();

        return response()->json([
            'data' => $games->map(function ($game) {
                return [
                    'id' => $game->id,
                    'title' => $game->title,
                    'description' => $game->description,
                    'version' => $game->version,
                    'cover_image' => $game->scenes->first()?->image ? asset('storage/' . $game->scenes->first()->image) : null,
                ];
            })
        ]);
    }
}
