<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Scene extends Model
{
    use HasFactory;

    public $incrementing = false; // car id = string ("PitchVogue")
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'game_id',
        'title',
        'description',
        'image',
        'is_ending',
        'conditions',
    ];

    protected $casts = [
        'is_ending' => 'boolean',
        'conditions' => 'array',
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