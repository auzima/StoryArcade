<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Classe représentant un jeu narratif.
 */
class Game extends Model
{
    use HasFactory;

    // Attributs pouvant être remplis en masse
    protected $fillable = [
        'title',          // Titre du jeu
        'author',         // Nom de l'auteur
        'version',        // Version du jeu
        'description',    // Description ou synopsis
        'cover_image',    // (optionnel) Image de couverture
        'initial_state',  // État initial du jeu (stocké au format JSON)
        'user_id',        // ID de l'utilisateur propriétaire
    ];

    // Définition des conversions automatiques de types
    protected $casts = [
        'initial_state' => 'array',
    ];

    /**
     * Un jeu possède plusieurs scènes.
     * Permet d'accéder aux scènes associées via $game->scenes.
     */
    public function scenes(): HasMany
    {
        return $this->hasMany(Scene::class);
    }

    /**
     * Un jeu appartient à un utilisateur.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
