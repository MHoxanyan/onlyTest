<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    /** @use HasFactory<\Database\Factories\CarFactory> */
    use HasFactory;

    protected $fillable = [
        'make', 'model', 'title', 'driver_id', 'comfort_level_id'
    ];

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    public function comfortLevel(): BelongsTo
    {
        return $this->belongsTo(ComfortLevel::class);
    }

    public function unavailableDays(): HasMany
    {
        return $this->hasMany(CarUnavailableDay::class);
    }
}
