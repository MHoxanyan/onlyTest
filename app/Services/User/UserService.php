<?php

namespace App\Services\User;

use App\DTO\UserDTO;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public static function createOrUpdate(UserDTO $DTO): ?User
    {
        return User::query()->updateOrCreate(
            ['id' => $DTO->id],
            [
                'email' => $DTO->email,
                'name' => $DTO->name,
                'position_id' => $DTO->position,
                'password' => Hash::make($DTO->password),
            ]
        );
    }
}
