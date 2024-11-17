<?php

namespace App\Services\User;

use App\Models\Position;

class PositionService
{
    public static function createOrUpdate(string $name, ?int $id = null): ?Position
    {
        return Position::query()->updateOrCreate(
            ['id' => $id],
            ['name' => $name],
        );
    }
}
