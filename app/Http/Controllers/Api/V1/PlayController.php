<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Scene;
use App\Models\Choice;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PlayController extends Controller
{
    /**
     * Démarrer un jeu
     *
     * @param Game $game
     * @return JsonResponse
     */
    public function start(Game $game): JsonResponse
    {
        if (!$game->is_published) {
            return response()->json(['message' => 'Jeu non trouvé'], 404);
        }

        $firstScene = $game->scenes()->orderBy('order')->first();

        if (!$firstScene) {
            return response()->json(['message' => 'Aucune scène disponible'], 404);
        }

        return response()->json([
            'data' => [
                'game' => [
                    'id' => $game->id,
                    'title' => $game->title,
                ],
                'scene' => [
                    'id' => $firstScene->id,
                    'title' => $firstScene->title,
                    'content' => $firstScene->content,
                    'choices' => $firstScene->choices->map(function ($choice) {
                        return [
                            'id' => $choice->id,
                            'text' => $choice->text,
                        ];
                    }),
                ],
            ],
        ]);
    }

    /**
     * Afficher une scène
     *
     * @param Scene $scene
     * @return JsonResponse
     */
    public function scene(Scene $scene): JsonResponse
    {
        if (!$scene->game->is_published) {
            return response()->json(['message' => 'Scène non trouvée'], 404);
        }

        return response()->json([
            'data' => [
                'id' => $scene->id,
                'title' => $scene->title,
                'content' => $scene->content,
                'choices' => $scene->choices->map(function ($choice) {
                    return [
                        'id' => $choice->id,
                        'text' => $choice->text,
                    ];
                }),
            ],
        ]);
    }
}
