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

    /**
     * Faire un choix
     *
     * @param Request $request
     * @param Scene $scene
     * @return JsonResponse
     */
    public function makeChoice(Request $request, Scene $scene): JsonResponse
    {
        $request->validate([
            'choice_id' => 'required|exists:choices,id',
        ]);

        $choice = Choice::findOrFail($request->choice_id);

        if ($choice->scene_id !== $scene->id) {
            return response()->json(['message' => 'Choix invalide'], 400);
        }

        $nextScene = Scene::find($choice->next_scene_id);

        if (!$nextScene) {
            return response()->json([
                'data' => [
                    'is_end' => true,
                    'message' => 'Fin de l\'histoire',
                ],
            ]);
        }

        return response()->json([
            'data' => [
                'is_end' => false,
                'next_scene' => [
                    'id' => $nextScene->id,
                    'title' => $nextScene->title,
                    'content' => $nextScene->content,
                    'choices' => $nextScene->choices->map(function ($choice) {
                        return [
                            'id' => $choice->id,
                            'text' => $choice->text,
                        ];
                    }),
                ],
            ],
        ]);
    }
}
