<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGameRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à effectuer cette requête.
     */
    public function authorize(): bool
    {
        return true; // ou $this->user()->admin si tu veux restreindre aux admins
    }

    /**
     * Règles de validation pour la création d'un jeu.
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:games,slug',
            'version' => 'required|string|max:50',
            'description' => 'nullable|string',
            'initial_state' => 'nullable|json',
        ];
    }
}