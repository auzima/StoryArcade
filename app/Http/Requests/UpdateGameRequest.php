<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGameRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à effectuer cette requête.
     */
    public function authorize(): bool
    {
        return true; // ou $this->user()->admin pour restreindre l'accès
    }

    /**
     * Règles de validation pour la mise à jour d'un jeu.
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:games,slug,' . $this->route('game')->id,
            'description' => 'nullable|string',
        ];
    }
}