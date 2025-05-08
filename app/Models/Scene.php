<?php

namespace App\Models; // Déclare le namespace pour organiser le code (ici, le dossier "Models").

use Illuminate\Database\Eloquent\Model; // Import de la classe de base Eloquent Model.
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Import pour préciser le type de relation "appartient à".
use Illuminate\Database\Eloquent\Relations\HasMany; // Import pour préciser le type de relation "a plusieurs".
use Illuminate\Database\Eloquent\Factories\HasFactory;

// Classe représentant une "scene" dans le jeu narratif.
class Scene extends Model
{
    use HasFactory;

    // Déclare les attributs modifiables en masse (lors d'une création ou mise à jour via create(), update(), etc.)
    protected $fillable = [
        'id',
        'game_id',
        'title',
        'description',
        'image',
        'is_ending',
        'conditions',
    ];

    // Spécifie comment certains attributs doivent être "castés" (transformés) lors de l'accès ou de la sauvegarde.
    protected $casts = [
        'is_ending' => 'boolean', // Transforme automatiquement en booléen.
        'conditions' => 'array',  // Transforme automatiquement en tableau depuis un champ JSON.
    ];

    public $incrementing = false; // On désactive l'auto-incrémentation car l'ID est une chaîne (ex. UUID).
    protected $keyType = 'string'; // Précise que la clé primaire est de type string (et non integer).

    /**
     * Relation : une scène appartient à un jeu.
     * Cela permet de récupérer le jeu associé à une scène via $scene->game.
     */
    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    /**
     * Relation : une scène peut avoir plusieurs choix (liens vers d'autres scènes).
     * Cela permet de récupérer tous les choix liés via $scene->choices.
     */
    public function choices(): HasMany
    {
        return $this->hasMany(Choice::class);
    }
}
