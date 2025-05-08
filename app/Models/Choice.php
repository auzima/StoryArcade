<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Classe représentant un choix dans une scène.
 */
class Choice extends Model
{
    use HasFactory;

    // Attributs remplissables en masse
    protected $fillable = [
        'id',              // Identifiant du choix (UUID ou auto-incrémenté)
        'scene_id',        // Scène d'origine
        'target_scene_id', // Scène vers laquelle ce choix mène
        'text',            // Texte affiché à l'utilisateur
        'effects',         // Effets produits par ce choix (JSON)
        'conditions',      // Conditions nécessaires pour rendre ce choix visible (JSON)
    ];

    // Types de données à caster automatiquement
    protected $casts = [
        'effects' => 'array',
        'conditions' => 'array',
    ];

    /**
     * Ce choix appartient à une scène d'origine.
     */
    public function scene(): BelongsTo
    {
        return $this->belongsTo(Scene::class, 'scene_id');
    }

    /**
     * Ce choix mène à une scène cible.
     */
    public function targetScene(): BelongsTo
    {
        return $this->belongsTo(Scene::class, 'target_scene_id');
    }
}
