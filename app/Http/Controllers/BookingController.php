<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\TourSchedule;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function index(Request $request): JsonResponse|View
    {
        $this->authorize('viewAny', Booking::class);

        $query = Booking::query()
            ->with(['tourSchedule.tourPackage', 'payment', 'review']);

        if ($request->user()->isStaff()) {
            if ($request->filled('status')) {
                $query->status($request->status);
            }
        } else {
            $query->forUser($request->user()->id);
        }

        $bookings = $query->latest()->paginate(15);

        if ($request->wantsJson()) {
            return response()->json($bookings);
        }

        if ($request->user()->isStaff()) {
            return view('admin.bookings.index', compact('bookings'));
        }

        return view('bookings.index', compact('bookings'));
    }

    public function show(Request $request, Booking $booking): JsonResponse
    {
        $this->authorize('view', $booking);

        $booking->load(['user', 'tourSchedule.tourPackage', 'payment', 'review']);

        return response()->json($booking);
    }

    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $this->authorize('create', Booking::class);

        $validated = $request->validate([
            'tour_schedule_id' => ['required', 'exists:tour_schedules,id'],
            'number_of_people' => ['required', 'integer', 'min:1'],
        ]);

        $booking = DB::transaction(function () use ($request, $validated) {
            $schedule = TourSchedule::query()
                ->lockForUpdate()
                ->with('tourPackage')
                ->findOrFail($validated['tour_schedule_id']);

            if ($schedule->status !== 'scheduled') {
                throw ValidationException::withMessages([
                    'tour_schedule_id' => ['This tour schedule is not available for booking.'],
                ]);
            }

            if ($schedule->seatsAvailable() < $validated['number_of_people']) {
                throw ValidationException::withMessages([
                    'number_of_people' => ['Not enough seats available. Only '.$schedule->seatsAvailable().' left.'],
                ]);
            }

            $totalPrice = $schedule->tourPackage->price * $validated['number_of_people'];

            $booking = Booking::create([
                'booking_code' => $this->generateBookingCode(),
                'user_id' => $request->user()->id,
                'tour_schedule_id' => $schedule->id,
                'number_of_people' => $validated['number_of_people'],
                'total_price' => $totalPrice,
                'status' => 'pending',
            ]);

            $schedule->increment('seats_booked', $validated['number_of_people']);

            return $booking->load(['tourSchedule.tourPackage', 'payment']);
        });

        return $this->respond(
            $request,
            $booking,
            201,
            route('bookings.payment.show', $booking),
            'Booking created! Please complete payment to confirm your trip.'
        );
    }

    public function updateStatus(Request $request, Booking $booking): JsonResponse|RedirectResponse
    {
        $this->authorize('update', $booking);

        $validated = $request->validate([
            'status' => ['required', 'in:pending,confirmed,cancelled,completed'],
        ]);

        if ($validated['status'] === 'cancelled') {
            return $this->cancel($request, $booking);
        }

        $booking->update(['status' => $validated['status']]);

        return $this->respond($request, $booking->fresh(), 200, null, 'Booking status updated.');
    }

    public function cancel(Request $request, Booking $booking): JsonResponse|RedirectResponse
    {
        $this->authorize('cancel', $booking);

        if (in_array($booking->status, ['cancelled', 'completed'])) {
            return $this->respond($request, ['message' => 'This booking cannot be cancelled.'], 422);
        }

        DB::transaction(function () use ($booking) {
            $schedule = TourSchedule::query()->lockForUpdate()->findOrFail($booking->tour_schedule_id);

            $schedule->decrement('seats_booked', $booking->number_of_people);
            $booking->update(['status' => 'cancelled']);

            if ($booking->payment && $booking->payment->status === 'paid') {
                $booking->payment->update(['status' => 'refunded']);
            } elseif ($booking->payment) {
                $booking->payment->update(['status' => 'failed']);
            }
        });

        return $this->respond($request, $booking->fresh()->load('payment'), 200, null, 'Booking cancelled.');
    }

    private function generateBookingCode(): string
    {
        do {
            $code = 'BK-'.strtoupper(Str::random(8));
        } while (Booking::where('booking_code', $code)->exists());

        return $code;
    }
}