<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Choice extends Model
{
    use HasFactory;

    protected $fillable = [
        'scene_id',
        'text',
        'next_scene',
        'effects',
        'conditions',
    ];

    protected $casts = [
        'effects' => 'array',
        'conditions' => 'array',
    ];

    public function scene(): BelongsTo
    {
        return $this->belongsTo(Scene::class);
    }
}