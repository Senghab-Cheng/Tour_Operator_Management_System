<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Review;
use App\Models\TourPackage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ReviewController extends Controller
{
    public function index(Request $request, TourPackage $tourPackage): JsonResponse
    {
        $reviews = $tourPackage->reviews()
            ->with('user:id,name')
            ->latest()
            ->paginate(10);

        return response()->json([
            'reviews' => $reviews,
            'average_rating' => $tourPackage->averageRating(),
        ]);
    }

    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'booking_id' => ['required', 'exists:bookings,id'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:2000'],
        ]);

        $booking = Booking::with('tourSchedule')->findOrFail($validated['booking_id']);

        if ($booking->user_id !== $request->user()->id) {
            abort(403, 'You can only review your own bookings.');
        }

        if ($booking->status === 'cancelled') {
            throw ValidationException::withMessages([
                'booking_id' => ['You can only review a booking that has not been cancelled.'],
            ]);
        }

        if ($booking->review) {
            throw ValidationException::withMessages([
                'booking_id' => ['This booking has already been reviewed.'],
            ]);
        }

        $review = Review::create([
            'booking_id' => $booking->id,
            'user_id' => $request->user()->id,
            'tour_package_id' => $booking->tourSchedule->tour_package_id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'] ?? null,
        ]);

        return $this->respond($request, $review->load('user:id,name'), 201, null, 'Review submitted.');
    }

    public function destroy(Request $request, Review $review): JsonResponse|RedirectResponse
    {
        if (! $request->user()->isStaff() && $review->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized.');
        }

        $review->delete();

        return $this->respond($request, null, 204, null, 'Review deleted.');
    }
}