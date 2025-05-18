<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Scene;
use App\Models\Choice;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $games = Game::with(['scenes', 'choices'])
            ->when(!$user->admin, function ($query) use ($user) {
                return $query->where('user_id', $user->id);
            })
            ->get();

        $stats = [
            'total_games' => $games->count(),
            'published_games' => $games->where('is_published', true)->count(),
            'total_scenes' => $games->sum(function ($game) {
                return $game->scenes->count();
            }),
            'total_choices' => $games->sum(function ($game) {
                return $game->choices->count();
            }),
        ];

        return view('dashboard', compact('games', 'stats'));
    }
}
