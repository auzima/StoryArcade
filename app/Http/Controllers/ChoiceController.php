<?php

namespace App\Http\Controllers;

use App\Models\Choice;
use App\Http\Requests\ChoiceRequest;
use Illuminate\Http\JsonResponse;

class ChoiceController extends Controller
{
    /**
     * Affiche la liste des choix.
     */
    public function index(): JsonResponse
    {
        $choices = Choice::with(['scene', 'nextScene'])->get();
        return response()->json($choices);
    }

    /**
     * Enregistre un nouveau choix.
     */
    public function store(ChoiceRequest $request): JsonResponse
    {
        $choice = Choice::create($request->validated());
        return response()->json($choice, 201);
    }

    /**
     * Affiche un choix spécifique.
     */
    public function show(Choice $choice): JsonResponse
    {
        $choice->load(['scene', 'nextScene']);
        return response()->json($choice);
    }

    /**
     * Met à jour un choix spécifique.
     */
    public function update(ChoiceRequest $request, Choice $choice): JsonResponse
    {
        $choice->update($request->validated());
        return response()->json($choice);
    }

    /**
     * Supprime un choix spécifique.
     */
    public function destroy(Choice $choice): JsonResponse
    {
        $choice->delete();
        return response()->json(null, 204);
    }
}
