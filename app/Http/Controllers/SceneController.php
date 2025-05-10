<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSceneRequest;
use App\Http\Requests\UpdateSceneRequest;
use App\Models\Scene;
use App\Models\Game;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SceneController extends Controller
{
    public function index(): View
    {
        $scenes = Scene::with('game')->get();
        return view('scenes.index', compact('scenes'));
    }

    public function create()
    {
        $games = Game::all();
        $selectedGameId = request()->query('game_id'); // récupère l'ID pré-rempli
        return view('scenes.create', compact('games', 'selectedGameId'));
    }

    public function store(StoreSceneRequest $request): RedirectResponse
    {
        $data = $request->validated();
    
        // Si un game_id est passé en query (ex: ?game_id=1), on l'ajoute
        if (request()->has('game_id')) {
            $data['game_id'] = request()->get('game_id');
        }
    
        // Sauvegarde l'image dans le dossier "public/scenes"
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('scenes', 'public');
        }
    
        // Simule un auteur
        $data['author'] = 'Invité';
    
        Scene::create($data);
    
        return redirect()->route('scenes.index')->with('success', 'Scène créée avec image !');
    }

    public function show(Scene $scene)
    {
        $scene->load('game'); // charge aussi les infos du jeu
        return view('games.scenes.show', compact('scene'));
    }


    public function edit(Scene $scene): View
{
    $games = Game::all();
    return view('games.scenes.edit', compact('scene', 'games'));
}

    public function update(UpdateSceneRequest $request, Scene $scene): RedirectResponse
    {
        $scene->update($request->validated());
        return redirect()->route('scenes.index')->with('success', 'Scène modifiée !');
    }

    public function destroy(Scene $scene): RedirectResponse
    {
        $scene->delete();
        return redirect()->route('scenes.index')->with('success', 'Scène supprimée.');
    }
}

