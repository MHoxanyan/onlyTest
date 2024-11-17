<?php

namespace App\Http\Resources\Car;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property string $make
 * @property string $model
 * @property string $title
 * @property \App\Http\Resources\Driver\DriverResource $driver
 * @property \App\Http\Resources\User\ComfortLevelResource $comfortLevel
 */
class CarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'make' => $this->make,
            'model' => $this->model,
            'title' => $this->title,
            'comfort_level' => $this->comfortLevel->name,
            'driver' => $this->driver->name,
        ];
    }
}
