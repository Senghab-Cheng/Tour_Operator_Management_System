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
        'name', 'phone', 'email', 'bio', 'photo', 'status',
    ];

    public function tourSchedules(): HasMany
    {
        return $this->hasMany(TourSchedule::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 'active');
    }
}
