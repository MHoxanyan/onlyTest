<?php

namespace App\DTO;

readonly class CarDTO
{
    public function __construct(
        public string $make,
        public string $model,
        public int $driver,
        public int $comfortLevel,
        public ?string $title,
        public ?int $id,
    ) {
    }
}
