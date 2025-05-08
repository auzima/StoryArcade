<?php

namespace App\Http\Controllers;

use App\Models\Scene;
use App\Http\Requests\SceneRequest;
use Illuminate\Http\JsonResponse;

class SceneController extends Controller
{
    /**
     * Affiche la liste des scènes.
     */
    public function index(): JsonResponse
    {
        $scenes = Scene::with(['game', 'choices'])->get();
        return response()->json($scenes);
    }

    /**
     * Enregistre une nouvelle scène.
     */
    public function store(SceneRequest $request): JsonResponse
    {
        $scene = Scene::create($request->validated());
        return response()->json($scene, 201);
    }

    /**
     * Affiche une scène spécifique.
     */
    public function show(Scene $scene): JsonResponse
    {
        $scene->load(['game', 'choices']);
        return response()->json($scene);
    }

    /**
     * Met à jour une scène spécifique.
     */
    public function update(SceneRequest $request, Scene $scene): JsonResponse
    {
        $scene->update($request->validated());
        return response()->json($scene);
    }

    /**
     * Supprime une scène spécifique.
     */
    public function destroy(Scene $scene): JsonResponse
    {
        $scene->delete();
        return response()->json(null, 204);
    }
}
