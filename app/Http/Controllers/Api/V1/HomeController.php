<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    /**
     * Récupère les informations de la page d'accueil
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => [
                'title' => 'Sauvage Lune',
                'description' => 'Plongez dans un univers mystérieux où chaque choix compte. Explorez des mondes uniques, rencontrez des personnages fascinants et écrivez votre propre histoire dans cette aventure interactive.',
                'features' => [
                    [
                        'icon' => '🎮',
                        'text' => 'Jeux interactifs'
                    ],
                    [
                        'icon' => '📖',
                        'text' => 'Histoires uniques'
                    ],
                    [
                        'icon' => '🌟',
                        'text' => 'Aventures captivantes'
                    ]
                ]
            ]
        ]);
    }
}
