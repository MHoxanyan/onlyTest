<?php

namespace App\Http\Requests\Car;

use App\DTO\UnavailableDayDTO;
use App\Rules\NoOverlappingTrips;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property int $car_id
 * @property int $user_id
 * @property string $start
 * @property string $end
 */
class UnavailableDayFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'car_id' => [
                'required',
                'exists:cars,id',
                Rule::when(
                    $this->car_id,
                    new NoOverlappingTrips(
                        $this->car_id,
                        $this->route('unavailable_day') ?? null,
                        $this->start,
                        $this->end,
                    )
                ),
            ],
            'start' => ['required', 'date_format:Y-m-d H:i:s'],
            'end' => ['required', 'date_format:Y-m-d H:i:s', 'after:start'],
            'user_id' => ['required', 'exists:users,id'],
        ];
    }

    public function getDTO(): UnavailableDayDTO
    {
        return new UnavailableDayDTO(
            carId: $this->car_id,
            userId: $this->user_id,
            start: $this->start,
            end: $this->end,
            id: $this->route('unavailable_day')
        );
    }
}
