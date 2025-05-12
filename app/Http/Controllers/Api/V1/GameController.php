<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\JsonResponse;

class GameController extends Controller
{
    /**
     * Récupère la liste des jeux disponibles
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $games = Game::with(['scenes'])
            ->where('is_published', true)
            ->get()
            ->map(function ($game) {
                return [
                    'id' => $game->id,
                    'title' => $game->title,
                    'description' => $game->description,
                    'thumbnail' => $game->thumbnail,
                    'scenes_count' => $game->scenes->count(),
                    'created_at' => $game->created_at,
                    'updated_at' => $game->updated_at,
                ];
            });

        return response()->json([
            'data' => $games
        ]);
    }
}
