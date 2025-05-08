<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SaveGame extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'user_id',
        'current_scene',
        'state',
    ];

    protected $casts = [
        'state' => 'array',
    ];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scene(): BelongsTo
{
    return $this->belongsTo(Scene::class, 'current_scene', 'id');
}
}