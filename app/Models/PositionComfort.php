<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PositionComfort extends Model
{
    /** @use HasFactory<\Database\Factories\PositionComfortFactory> */
    use HasFactory;

    protected $fillable = [
        'position_id', 'comfort_level_id'
    ];

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    public function comfortLevel(): BelongsTo
    {
        return $this->belongsTo(ComfortLevel::class);
    }
}
