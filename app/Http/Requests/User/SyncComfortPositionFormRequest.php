<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class SyncComfortPositionFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'position_id' => ['required', 'exists:positions,id'],
            'comfort_levels' => ['required', 'array'],
            'comfort_levels.*' => ['required', 'exists:comfort_levels,id'],
        ];
    }
}
