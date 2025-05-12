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
        $query = Game::with(['scenes', 'user'])
            ->where('is_published', true);

        // Filtrage par difficulté
        if ($request->has('difficulty')) {
            $query->where('difficulty', $request->difficulty);
        }

        // Tri
        $sortField = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');
        $query->orderBy($sortField, $sortDirection);

        $games = $query->paginate(12);

        return response()->json([
            'data' => new GameCollection($games),
            'meta' => [
                'current_page' => $games->currentPage(),
                'last_page' => $games->lastPage(),
                'per_page' => $games->perPage(),
                'total' => $games->total(),
                'last_updated' => now()->format('Y-m-d H:i:s')
            ]
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
        if (!$game->is_published) {
            return response()->json(['message' => 'Jeu non trouvé'], 404);
        }

        return response()->json([
            'data' => new GameResource($game->load(['scenes', 'user']))
        ]);
    }
}
 