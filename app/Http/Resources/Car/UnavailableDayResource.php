<?php

namespace App\Http\Resources\Car;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UnavailableDayResource extends JsonResource
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
            'start' => $this->start->format('Y-m-d H:i'),
            'end' => $this->end->format('Y-m-d H:i'),
            'user' => $this->user->name,
            'car' => CarResource::make($this->car),
        ];
    }
}
