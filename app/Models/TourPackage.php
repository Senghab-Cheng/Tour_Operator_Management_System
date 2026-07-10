<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class TourPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'destination', 'description', 'price',
        'duration_days', 'duration_nights', 'cover_image', 'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'duration_days' => 'integer',
        'duration_nights' => 'integer',
    ];

    protected static function booted(): void
    {
        static::creating(function (TourPackage $package) {
            if (empty($package->slug)) {
                $package->slug = Str::slug($package->title);
            }
        });
    }

    public function itineraryItems(): HasMany
    {
        return $this->hasMany(ItineraryItem::class)->orderBy('day_number');
    }

    public function tourSchedules(): HasMany
    {
        return $this->hasMany(TourSchedule::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function averageRating(): float
    {
        return round($this->reviews()->avg('rating') ?? 0, 1);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 'active');
    }

    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        if (! $term) {
            return $query;
        }

        return $query->where(function ($q) use ($term) {
            $q->where('title', 'like', "%{$term}%")
                ->orWhere('destination', 'like', "%{$term}%");
        });
    }
}
