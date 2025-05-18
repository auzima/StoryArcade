<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Choice\StoreChoiceRequest;
use App\Http\Requests\Web\Choice\UpdateChoiceRequest;
use App\Models\Scene;
use App\Models\Choice;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ChoiceController extends Controller
{
    /**
     * Affiche la liste des choix d'une scène
     */
    public function index(Scene $scene): View
    {
        $scene->load(['game', 'choices' => function ($query) {
            $query->orderBy('order');
        }]);
        return view('choices.index', compact('scene'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create(Scene $scene): View
    {
        $scene->load('game');
        $availableScenes = $scene->game->scenes()
            ->where('id', '!=', $scene->id)
            ->orderBy('order')
            ->get();
        return view('choices.create', compact('scene', 'availableScenes'));
    }

    /**
     * Enregistre un nouveau choix
     */
    public function store(StoreChoiceRequest $request, Scene $scene): RedirectResponse
    {
        $choice = $scene->choices()->create([
            ...$request->validated(),
            'order' => $scene->choices()->max('order') + 1,
        ]);

        return redirect()->route('games.scenes.choices.index', $scene)
            ->with('success', 'Le choix a été créé avec succès.');
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(Scene $scene, Choice $choice): View
    {
        $scene->load('game');
        $availableScenes = $scene->game->scenes()
            ->where('id', '!=', $scene->id)
            ->orderBy('order')
            ->get();
        return view('choices.edit', compact('scene', 'choice', 'availableScenes'));
    }

    /**
     * Met à jour un choix
     */
    public function update(UpdateChoiceRequest $request, Scene $scene, Choice $choice): RedirectResponse
    {
        $choice->update($request->validated());

        return redirect()->route('games.scenes.choices.index', $scene)
            ->with('success', 'Le choix a été mis à jour avec succès.');
    }

    /**
     * Supprime un choix
     */
    public function destroy(Scene $scene, Choice $choice): RedirectResponse
    {
        $choice->delete();

        // Réordonner les choix restants
        $scene->choices()
            ->where('order', '>', $choice->order)
            ->decrement('order');

        return redirect()->route('games.scenes.choices.index', $scene)
            ->with('success', 'Le choix a été supprimé avec succès.');
    }
}
