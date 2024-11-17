<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Position extends Model
{
    /** @use HasFactory<\Database\Factories\PositionFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function comfortLevels(): HasManyThrough
    {
        return $this->hasManyThrough(
            ComfortLevel::class,
            PositionComfort::class,
            'position_id',
            'id',
            'id',
            'comfort_level_id'
        );
    }
}
