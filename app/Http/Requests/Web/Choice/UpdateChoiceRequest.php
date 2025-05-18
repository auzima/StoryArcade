<?php

namespace App\Http\Requests\Web\Choice;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->isAdmin() || $this->choice->scene->game->user_id === $this->user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'text' => ['required', 'string', 'max:255'],
            'next_scene_id' => ['required', 'exists:scenes,id'],
            'order' => ['nullable', 'integer', 'min:0'],
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
            'text.required' => 'Le texte est obligatoire.',
            'text.max' => 'Le texte ne peut pas dépasser 255 caractères.',
            'next_scene_id.required' => 'La scène suivante est obligatoire.',
            'next_scene_id.exists' => 'La scène suivante n\'existe pas.',
            'order.integer' => 'L\'ordre doit être un nombre entier.',
            'order.min' => 'L\'ordre ne peut pas être négatif.',
        ];
    }
}
