<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Game;
use App\Models\Scene;
use App\Models\Choice;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonData = json_decode(file_get_contents(database_path('data/game.json')), true);

        // Créer le jeu
        $game = Game::create([
            'title' => $jsonData['game']['title'],
            'author' => $jsonData['game']['author'],
            'version' => $jsonData['game']['version'],
            'description' => $jsonData['game']['description'],
            'initial_state' => $jsonData['game']['initial_state']
        ]);

        // Créer les scènes
        foreach ($jsonData['scenes'] as $sceneData) {
            $scene = Scene::create([
                'game_id' => $game->id,
                'title' => $sceneData['title'],
                'description' => $sceneData['description'],
                'image' => $sceneData['image'] ?? null,
                'is_ending' => $sceneData['is_ending'] ?? false,
                'conditions' => $sceneData['conditions'] ?? null
            ]);

            // Créer les choix pour chaque scène
            if (isset($sceneData['choices'])) {
                foreach ($sceneData['choices'] as $choiceData) {
                    Choice::create([
                        'scene_id' => $scene->id,
                        'text' => $choiceData['text'],
                        'next_scene' => $choiceData['next_scene'],
                        'effects' => $choiceData['effects'],
                        'conditions' => $choiceData['conditions'] ?? null
                    ]);
                }
            }
        }
    }
}
