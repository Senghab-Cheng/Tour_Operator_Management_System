<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TourSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_package_id', 'tour_guide_id', 'vehicle_id', 'departure_date',
        'pickup_point', 'pickup_time', 'max_seats', 'seats_booked', 'status',
    ];

    protected $casts = [
        'departure_date' => 'date',
        'max_seats' => 'integer',
        'seats_booked' => 'integer',
    ];

    public function tourPackage(): BelongsTo
    {
        return $this->belongsTo(TourPackage::class);
    }

    public function tourGuide(): BelongsTo
    {
        return $this->belongsTo(TourGuide::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(TourScheduleComment::class);
    }

    public function seatsAvailable(): int
    {
        return $this->max_seats - $this->seats_booked;
    }

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('status', 'scheduled')
            ->where('departure_date', '>=', now()->toDateString());
    }

    public function scopeScheduled(Builder $query): Builder
    {
        return $query->where('status', 'scheduled');
    }
}
