<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class ComfortLevel extends Model
{
    /** @use HasFactory<\Database\Factories\ComfortLevelFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function positions(): HasManyThrough
    {
        return $this->hasManyThrough(
            Position::class,
            PositionComfort::class,
            'comfort_level_id',
            'id',
            'id',
            'position_id'
        );
    }
}
