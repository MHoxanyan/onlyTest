<?php

namespace App\Services\Car;

use App\DTO\CarDTO;
use App\DTO\UnavailableDayDTO;
use App\Models\Car;
use App\Models\CarUnavailableDay;

class CarService
{
    public static function createOrUpdate(CarDTO $DTO): ?Car
    {
        return Car::updateOrCreate(
            ['id' => $DTO->id],
            [
                'make' => $DTO->make,
                'model' => $DTO->model,
                'title' => $DTO->title,
                'comfort_level_id' => $DTO->comfortLevel,
                'driver_id' => $DTO->driver
            ],
        );
    }

    public static function createOrUpdateUnavailableDay(UnavailableDayDTO $DTO): ?CarUnavailableDay
    {
        return  CarUnavailableDay::query()->updateOrCreate(
            ['id' => $DTO->id],
            [
                'car_id' => $DTO->carId,
                'user_id' => $DTO->userId,
                'start' => $DTO->start,
                'end' => $DTO->end,
            ],
        );
    }
}
