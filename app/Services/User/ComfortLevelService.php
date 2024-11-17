<?php

namespace App\Services\User;

use App\Models\ComfortLevel;

class ComfortLevelService
{
    public static function createOrUpdate(string $name, ?int $id = null): ?ComfortLevel
    {
        return ComfortLevel::query()->updateOrCreate(
            ['id' => $id],
            ['name' => $name],
        );
    }
}
