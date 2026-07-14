<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TourGuide extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'phone', 'email', 'bio', 'skills', 'photo', 'status',
    ];

    public function tourSchedules(): HasMany
    {
        return $this->hasMany(TourSchedule::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(TourScheduleComment::class);
    }

    public function skillList(): array
    {
        return $this->skills ? array_map('trim', explode(',', $this->skills)) : [];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 'active');
    }
}