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

    public function store(StoreSceneRequest $request, Game $game): RedirectResponse
    {
        $data = $request->validated();
        $data['game_id'] = $game->id;
    
        // Simule un admin si `?admin=1` dans l’URL
        $data['author'] = 'Invité';
    
        Scene::create($data);
    
        return redirect()->route('games.scenes.index', $game)->with('success', 'Scène créée !');
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