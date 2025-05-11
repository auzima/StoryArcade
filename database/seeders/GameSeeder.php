<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game;
use App\Models\Scene;
use App\Models\Choice;

class GameSeeder extends Seeder
{
    public function run(): void
    {
        $jsonData = json_decode(file_get_contents(database_path('data/game.json')), true);

        // Créer le jeu principal
        $game = Game::create([
            'title' => $jsonData['game']['title'],
            'author' => $jsonData['game']['author'],
            'version' => $jsonData['game']['version'],
            'description' => $jsonData['game']['description'],
            'initial_state' => $jsonData['game']['initial_state']
        ]);

        // Stocker les scènes créées avec leur ID personnalisée
        $sceneMap = [];

        foreach ($jsonData['scenes'] as $sceneData) {
            $scene = Scene::create([
                'id' => $sceneData['id'],
                'game_id' => $game->id,
                'title' => $sceneData['title'],
                'description' => $sceneData['description'],
                'image' => $sceneData['image'] ?? null,
                'is_ending' => $sceneData['is_ending'] ?? false,
                'conditions' => $sceneData['conditions'] ?? null,
            ]);

            $sceneMap[$scene->id] = $scene->id;
        }

        foreach ($jsonData['scenes'] as $sceneData) {
            $originSceneId = $sceneData['id'];
            foreach ($sceneData['choices'] ?? [] as $choiceData) {
                $targetId = $choiceData['next_scene'];

                if (!isset($sceneMap[$targetId])) {
                    throw new \Exception("Scène cible '{$targetId}' non trouvée. Vérifie les IDs dans le JSON.");
                }

                Choice::create([
                    'scene_id' => $originSceneId,
                    'text' => $choiceData['text'],
                    'next_scene' => $targetId,
                    'effects' => $choiceData['effects'] ?? [],
                    'conditions' => $choiceData['conditions'] ?? null,
                ]);
            }
        }
    }
}
