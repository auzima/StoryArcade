<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChoiceRequest extends FormRequest
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
            'text' => ['required', 'string', 'max:255'],
            'scene_id' => ['required', 'exists:scenes,id'],
            'next_scene_id' => ['required', 'exists:scenes,id'],
            'order' => ['required', 'integer', 'min:0'],
            'effect' => ['nullable', 'string', 'max:255'],
            'condition' => ['nullable', 'string', 'max:255']
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
            'text.required' => 'Le texte est requis.',
            'text.max' => 'Le texte ne peut pas dépasser 255 caractères.',
            'scene_id.required' => 'La scène est requise.',
            'scene_id.exists' => 'La scène sélectionnée n\'existe pas.',
            'next_scene_id.required' => 'La scène suivante est requise.',
            'next_scene_id.exists' => 'La scène suivante sélectionnée n\'existe pas.',
            'order.required' => 'L\'ordre est requis.',
            'order.integer' => 'L\'ordre doit être un nombre entier.',
            'order.min' => 'L\'ordre doit être supérieur ou égal à 0.',
            'effect.max' => 'L\'effet ne peut pas dépasser 255 caractères.',
            'condition.max' => 'La condition ne peut pas dépasser 255 caractères.'
        ];
    }
}
