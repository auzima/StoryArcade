<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Scene;
use App\Models\Game;
use App\Http\Resources\SceneResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SceneController extends Controller
{
    /**
     * Afficher la liste des scènes d'un jeu
     *
     * @param Game $game
     * @return JsonResponse
     */
    public function index(Game $game): JsonResponse
    {
        $scenes = $game->scenes()->orderBy('order')->get();
        return response()->json([
            'data' => SceneResource::collection($scenes)
        ]);
    }

    /**
     * Créer une nouvelle scène
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'game_id' => 'required|exists:games,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'order' => 'required|integer|min:0',
        ]);

        $scene = Scene::create($validated);

        return response()->json([
            'data' => new SceneResource($scene)
        ], 201);
    }

    /**
     * Afficher une scène spécifique
     *
     * @param Scene $scene
     * @return JsonResponse
     */
    public function show(Scene $scene): JsonResponse
    {
        return response()->json([
            'data' => new SceneResource($scene->load('choices'))
        ]);
    }

    /**
     * Mettre à jour une scène
     *
     * @param Request $request
     * @param Scene $scene
     * @return JsonResponse
     */
    public function update(Request $request, Scene $scene): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
            'order' => 'sometimes|required|integer|min:0',
        ]);

        $scene->update($validated);

        return response()->json([
            'data' => new SceneResource($scene)
        ]);
    }

    /**
     * Supprimer une scène
     *
     * @param Scene $scene
     * @return JsonResponse
     */
    public function destroy(Scene $scene): JsonResponse
    {
        $scene->delete();
        return response()->json(null, 204);
    }
}
