<?php

namespace App\Http\Controllers;

use App\Models\TourSchedule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TourScheduleCommentController extends Controller
{
    public function store(Request $request, TourSchedule $tourSchedule): RedirectResponse
    {
        $validated = $request->validate([
            'tour_guide_id' => ['required', 'exists:tour_guides,id'],
            'comment' => ['required', 'string', 'max:2000'],
        ]);

        $tourSchedule->comments()->create([
            'tour_guide_id' => $validated['tour_guide_id'],
            'posted_by' => $request->user()->id,
            'comment' => $validated['comment'],
        ]);

        return back()->with('success', 'Comment added.');
    }
}