<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'version',
        'is_published',
        'user_id',
        'author',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function scenes(): HasMany
    {
        return $this->hasMany(Scene::class);
    }

    public function choices(): HasMany
    {
        return $this->hasMany(Choice::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function firstScene()
    {
        return $this->scenes()->orderBy('order')->first();
    }
}
