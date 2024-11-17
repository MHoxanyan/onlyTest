<?php

namespace App\Rules;

use App\Models\CarUnavailableDay;
use Illuminate\Contracts\Validation\Rule;

class NoOverlappingTrips implements Rule
{
    public function __construct(
        private ?int    $carId,
        private ?int    $tripId,
        private ?string $start,
        private ?string $end,
    ) {
    }

    public function passes($attribute, $value)
    {
        if (in_array(null, [$this->carId, $this->end, $this->start])) {
            return false;
        }

        $start = $this->start;
        $end = $this->end;

        $query = CarUnavailableDay::query()
            ->where('car_id', $this->carId)
            ->available($start, $end);


        if ($this->tripId) {
            $query->where('id', '<>', $this->tripId);
        }

        return !$query->exists();
    }

    public function message()
    {
        return 'The car is already scheduled for another trip during the selected time.';
    }
}
