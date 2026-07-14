<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TourScheduleComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_schedule_id', 'tour_guide_id', 'posted_by', 'comment',
    ];

    public function tourSchedule(): BelongsTo
    {
        return $this->belongsTo(TourSchedule::class);
    }

    public function tourGuide(): BelongsTo
    {
        return $this->belongsTo(TourGuide::class);
    }

    public function postedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'posted_by');
    }
}