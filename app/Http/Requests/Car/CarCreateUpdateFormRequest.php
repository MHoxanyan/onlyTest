<?php

namespace App\Http\Requests\Car;

use App\DTO\CarDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CarCreateUpdateFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'make' => ['required', 'string', 'max:25'],
            'model' => ['required', 'string', 'max:25'],
            'driver_id' => ['required', 'exists:drivers,id', Rule::unique('cars', 'driver_id')->ignore($this->route('car'))],
            'title' => ['nullable'],
            'comfort_level_id' => ['required', 'exists:comfort_levels,id'],
        ];
    }

    public function getDTO(): CarDTO
    {
        return new CarDTO(
            make: $this->validated('make'),
            model: $this->validated('model'),
            driver: $this->validated('driver_id'),
            comfortLevel: $this->validated('comfort_level_id'),
            title: $this->validated('title'),
            id: $this->route('car'),
        );
    }
}
