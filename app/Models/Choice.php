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
        'next_scene_id',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    public function scene(): BelongsTo
    {
        return $this->belongsTo(Scene::class);
    }

    public function nextScene(): BelongsTo
    {
        return $this->belongsTo(Scene::class, 'next_scene_id');
    }
}
