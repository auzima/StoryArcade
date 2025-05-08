<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveGameRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'current_scene_id' => ['required', 'exists:scenes,id'],
            'player_effects' => ['required', 'array'],
            'player_effects.*' => ['string', 'max:255'],
            'inventory' => ['required', 'array'],
            'inventory.*' => ['string', 'max:255'],
            'game_state' => ['required', 'array'],
            'game_state.*' => ['string', 'max:255'],
            'last_saved_at' => ['required', 'date']
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'user_id.required' => 'L\'utilisateur est requis.',
            'user_id.exists' => 'L\'utilisateur sélectionné n\'existe pas.',
            'current_scene_id.required' => 'La scène actuelle est requise.',
            'current_scene_id.exists' => 'La scène sélectionnée n\'existe pas.',
            'player_effects.required' => 'Les effets du joueur sont requis.',
            'player_effects.array' => 'Les effets du joueur doivent être un tableau.',
            'player_effects.*.max' => 'Chaque effet ne peut pas dépasser 255 caractères.',
            'inventory.required' => 'L\'inventaire est requis.',
            'inventory.array' => 'L\'inventaire doit être un tableau.',
            'inventory.*.max' => 'Chaque élément de l\'inventaire ne peut pas dépasser 255 caractères.',
            'game_state.required' => 'L\'état du jeu est requis.',
            'game_state.array' => 'L\'état du jeu doit être un tableau.',
            'game_state.*.max' => 'Chaque état ne peut pas dépasser 255 caractères.',
            'last_saved_at.required' => 'La date de sauvegarde est requise.',
            'last_saved_at.date' => 'La date de sauvegarde doit être une date valide.'
        ];
    }
}
