<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaveGame extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'current_scene_id',
        'player_effects',
        'inventory',
        'game_state',
        'last_saved_at'
    ];

    protected $casts = [
        'player_effects' => 'array',
        'inventory' => 'array',
        'game_state' => 'array',
        'last_saved_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function currentScene()
    {
        return $this->belongsTo(Scene::class, 'current_scene_id');
    }
}
