<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Choice;
use App\Models\Scene;
use App\Http\Resources\ChoiceResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChoiceController extends Controller
{
    /**
     * Afficher la liste des choix d'une scène
     *
     * @param Scene $scene
     * @return JsonResponse
     */
    public function index(Scene $scene): JsonResponse
    {
        $choices = $scene->choices;
        return response()->json([
            'data' => ChoiceResource::collection($choices)
        ]);
    }

    /**
     * Créer un nouveau choix
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'scene_id' => 'required|exists:scenes,id',
            'text' => 'required|string|max:255',
            'next_scene_id' => 'required|exists:scenes,id',
        ]);

        $choice = Choice::create($validated);

        return response()->json([
            'data' => new ChoiceResource($choice)
        ], 201);
    }

    /**
     * Afficher un choix spécifique
     *
     * @param Choice $choice
     * @return JsonResponse
     */
    public function show(Choice $choice): JsonResponse
    {
        return response()->json([
            'data' => new ChoiceResource($choice)
        ]);
    }

    /**
     * Mettre à jour un choix
     *
     * @param Request $request
     * @param Choice $choice
     * @return JsonResponse
     */
    public function update(Request $request, Choice $choice): JsonResponse
    {
        $validated = $request->validate([
            'text' => 'sometimes|required|string|max:255',
            'next_scene_id' => 'sometimes|required|exists:scenes,id',
        ]);

        $choice->update($validated);

        return response()->json([
            'data' => new ChoiceResource($choice)
        ]);
    }

    /**
     * Supprimer un choix
     *
     * @param Choice $choice
     * @return JsonResponse
     */
    public function destroy(Choice $choice): JsonResponse
    {
        $choice->delete();
        return response()->json(null, 204);
    }
}
