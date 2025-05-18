<?php

namespace App\Http\Requests\Web\Scene;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSceneRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->isAdmin() || $this->scene->game->user_id === $this->user()->id;
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
            'image' => ['nullable', 'image', 'max:2048'], // 2MB max
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
            'title.required' => 'Le titre est obligatoire.',
            'title.max' => 'Le titre ne peut pas dépasser 255 caractères.',
            'content.required' => 'Le contenu est obligatoire.',
            'image.image' => 'Le fichier doit être une image.',
            'image.max' => 'L\'image ne peut pas dépasser 2MB.',
            'order.integer' => 'L\'ordre doit être un nombre entier.',
            'order.min' => 'L\'ordre ne peut pas être négatif.',
        ];
    }
}
