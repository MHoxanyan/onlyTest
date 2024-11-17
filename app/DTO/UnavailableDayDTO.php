<?php

namespace App\DTO;

readonly class UnavailableDayDTO
{
    public function __construct(
        public int $carId,
        public int $userId,
        public string $start,
        public string $end,
        public ?int $id,
    ) {
    }
}
