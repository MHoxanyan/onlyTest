<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarUnavailableDay extends Model
{
    /** @use HasFactory<\Database\Factories\CarUnavailableDayFactory> */
    use HasFactory;

    protected $fillable = [
        'car_id', 'start', 'end', 'user_id',
    ];

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
    ];

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeAvailable($query, $start, $end)
    {
        //        dd($query);
        return $query->where(function ($q) use ($start, $end) {
            $q->where(function ($q) use ($start, $end) {
                $q->where('start', '>=', $start)
                    ->where('start', '<', $end);
            })
                ->orWhere(function ($q) use ($start, $end) {
                    $q->where('start', '<=', $start)
                        ->where('end', '>', $end);
                })
                ->orWhere(function ($q) use ($start, $end) {
                    $q->where('end', '>', $start)
                        ->where('end', '<', $end);
                })
                ->orWhere(function ($q) use ($start, $end) {
                    $q->where('start', '>=', $start)
                        ->where('end', '<', $end);
                })
                ->orWhere(function ($q) use ($start, $end) {
                    $q->where('start', '<', $start)
                        ->where('end', '=', $end);
                });
        });
    }
}
