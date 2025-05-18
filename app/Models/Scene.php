<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Scene extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'title',
        'content',
        'image',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    public function choices(): HasMany
    {
        return $this->hasMany(Choice::class);
    }
}
