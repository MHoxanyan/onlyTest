<?php

namespace App\Services\Driver;

use App\Models\Driver;

class DriverService
{
    public static function createOrUpdate(string $name, ?int $id = null): ?Driver
    {
        return Driver::query()->updateOrCreate(
            ['id' => $id],
            ['name' => $name],
        );
    }
}
