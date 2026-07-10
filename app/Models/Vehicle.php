<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'plate_number', 'capacity', 'driver_name', 'driver_phone', 'status',
    ];

    protected $casts = [
        'capacity' => 'integer',
    ];

    public function tourSchedules(): HasMany
    {
        return $this->hasMany(TourSchedule::class);
    }

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('status', 'available');
    }
}
