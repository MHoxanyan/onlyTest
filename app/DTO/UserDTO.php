<?php

namespace App\DTO;

readonly class UserDTO
{
    public function __construct(
        public string $email,
        public string $name,
        public int    $position,
        public string $password,
        public ?int   $id,
    ) {
    }
}
