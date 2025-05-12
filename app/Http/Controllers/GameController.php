<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;

class GameController extends Controller
{
    /**
     * Affiche la liste des jeux.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $games = Game::select(['id', 'title', 'description', 'author', 'version'])
                ->get()
                ->map(function ($game) {
                    return [
                        'id' => $game->id,
                        'title' => $game->title,
                        'description' => $game->description,
                        'author' => $game->author,
                        'version' => $game->version,
                        'cover_image' => $game->scenes->first()?->image
                            ? asset('storage/' . $game->scenes->first()->image)
                            : null,
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $games
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération des jeux',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Affiche le formulaire de création d'un jeu.
     */
    public function create()
    {
        return view('games.create');
    }

    /**
     * Enregistre un nouveau jeu.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'author' => 'required|string|max:255',
            'version' => 'required|string|max:50',
        ]);

        $game = Game::create($validated);

        return redirect()->route('dashboard')
            ->with('success', 'Jeu créé avec succès.');
    }

    /**
     * Affiche un jeu spécifique.
     */
    public function show(Game $game)
    {
        $game->load('scenes');
        return view('games.show', compact('game'));
    }

    /**
     * Affiche le formulaire d'édition d'un jeu.
     */
    public function edit(Game $game)
    {
        return view('games.edit', compact('game'));
    }

    /**
     * Met à jour un jeu spécifique.
     */
    public function update(Request $request, Game $game)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'author' => 'required|string|max:255',
            'version' => 'required|string|max:50',
        ]);

        $game->update($validated);

        return redirect()->route('dashboard')
            ->with('success', 'Jeu mis à jour avec succès.');
    }

    /**
     * Supprime un jeu spécifique.
     */
    public function destroy(Game $game)
    {
        $game->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Jeu supprimé avec succès.');
    }
}
