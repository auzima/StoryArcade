<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSaveGameRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'nullable|exists:users,id',
            'game_id' => 'required|exists:games,id',
            'current_scene' => 'required|string|exists:scenes,id',
            'state' => 'required|json',
        ];
    }
}