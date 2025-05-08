<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'scene_id' => 'required|exists:scenes,id',
            'next_scene_id' => 'required|exists:scenes,id',
            'text' => 'required|string|max:255',
            'order' => 'required|integer|min:0',
            'effect' => 'nullable|string|max:255',
            'condition' => 'nullable|string|max:255',
        ];
    }
}