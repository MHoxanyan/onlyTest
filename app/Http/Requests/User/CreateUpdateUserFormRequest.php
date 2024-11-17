<?php

namespace App\Http\Requests\User;

use App\DTO\UserDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUpdateUserFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'email' => [
                Rule::unique('users', 'email')->ignore($this->route('user')),
                'required',
                'email:dns',
            ],
            'position' => ['required', 'exists:positions,id'],
            'password' => ['required', 'confirmed'],
        ];
    }

    public function getDTO(): UserDTO
    {
        return new UserDTO(
            email: $this->validated('email'),
            name: $this->validated('name'),
            position: $this->validated('position'),
            password: $this->validated('password'),
            id: $this->route('user') ? $this->route('user') : null
        );
    }
}
