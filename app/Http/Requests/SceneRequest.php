<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SceneRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'game_id' => ['required', 'exists:games,id'],
            'order' => ['required', 'integer', 'min:0'],
            'is_final' => ['boolean'],
            'background_image' => ['nullable', 'string', 'max:255'],
            'background_music' => ['nullable', 'string', 'max:255']
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
            'title.required' => 'Le titre est requis.',
            'title.max' => 'Le titre ne peut pas dépasser 255 caractères.',
            'content.required' => 'Le contenu est requis.',
            'game_id.required' => 'Le jeu est requis.',
            'game_id.exists' => 'Le jeu sélectionné n\'existe pas.',
            'order.required' => 'L\'ordre est requis.',
            'order.integer' => 'L\'ordre doit être un nombre entier.',
            'order.min' => 'L\'ordre doit être supérieur ou égal à 0.',
            'background_image.max' => 'Le chemin de l\'image de fond ne peut pas dépasser 255 caractères.',
            'background_music.max' => 'Le chemin de la musique de fond ne peut pas dépasser 255 caractères.'
        ];
    }
}
