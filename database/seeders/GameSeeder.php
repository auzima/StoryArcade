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
        // Créer un jeu de test
        $game = Game::create([
            'title' => 'Sauvage & Lune',
            'description' => 'Une aventure mystérieuse dans un monde enchanté où chaque choix compte.',
            'version' => '1.0',
            'is_published' => true,
            'user_id' => 1,
            'author' => 'Sauvage Lune Team'
        ]);

        // Créer les scènes
        $scenes = [
            [
                'title' => 'Le Début',
                'content' => 'Vous vous réveillez dans une clairière mystérieuse. Le soleil commence à se coucher et vous entendez des bruits étranges dans les buissons.',
                'order' => 1,
                'image' => null
            ],
            [
                'title' => 'La Clairière',
                'content' => 'La clairière est baignée d\'une lumière dorée. Des fleurs lumineuses dansent doucement dans la brise.',
                'order' => 2,
                'image' => null
            ],
            [
                'title' => 'La Grotte',
                'content' => 'Une grotte sombre s\'ouvre devant vous. Des cristaux brillants ornent ses parois.',
                'order' => 3,
                'image' => null
            ]
        ];

        $createdScenes = [];
        foreach ($scenes as $sceneData) {
            $scene = Scene::create([
                'game_id' => $game->id,
                'title' => $sceneData['title'],
                'content' => $sceneData['content'],
                'order' => $sceneData['order'],
                'image' => $sceneData['image']
            ]);
            $createdScenes[] = $scene;
        }

        // Ajouter des choix pour chaque scène
        foreach ($createdScenes as $index => $scene) {
            if ($index < count($createdScenes) - 1) {
                Choice::create([
                    'game_id' => $game->id,
                    'scene_id' => $scene->id,
                    'text' => 'Continuer l\'aventure',
                    'next_scene_id' => $createdScenes[$index + 1]->id,
                    'order' => 1
                ]);
            }
        }
    }
}
