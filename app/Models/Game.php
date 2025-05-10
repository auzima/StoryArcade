<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'version',
        'description',
        'initial_state',
    ];

    protected $casts = [
        'initial_state' => 'array',
    ];
  

    public function scenes(): HasMany
    {
        return $this->hasMany(Scene::class);
    }

    public function saves(): HasMany
    {
        return $this->hasMany(SaveGame::class);
    }

    // App\Models\Game.php
public function firstScene()
{
    return $this->scenes()->orderBy('id')->first();
}
}