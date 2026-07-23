<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function show(Request $request, Payment $payment): JsonResponse
    {
        $this->authorize('view', $payment);

        $payment->load(['booking.user', 'booking.tourSchedule.tourPackage']);

        return response()->json($payment);
    }

    /**
     * Customer-facing payment page for a booking: choose a method and,
     * for ABA, see a QR image / payment link.
     */
    public function showForBooking(Request $request, Booking $booking): View
    {
        abort_unless(
            $request->user()->isStaff() || $booking->user_id === $request->user()->id,
            403
        );

        $booking->load(['payment', 'tourSchedule.tourPackage']);

        return view('bookings.payment', compact('booking'));
    }

    /**
     * Customer selects a payment method for their booking (used by both the
     * customer-facing payment page and the admin "record payment" form).
     */
    public function store(Request $request, Booking $booking): JsonResponse|RedirectResponse
    {
        abort_unless(
            $request->user()->isStaff() || $booking->user_id === $request->user()->id,
            403
        );

        if ($booking->payment) {
            return $this->respond($request, ['message' => 'Payment already exists for this booking.'], 422);
        }

        $validated = $request->validate([
            'method' => ['required', 'in:cash,aba'],
            'transaction_ref' => ['nullable', 'string', 'max:255'],
        ]);

        $payment = Payment::create([
            'booking_id' => $booking->id,
            'amount' => $booking->total_price,
            'method' => $validated['method'],
            'status' => 'pending',
            'transaction_ref' => $validated['transaction_ref'] ?? null,
        ]);

        if ($request->routeIs('bookings.payment.store')) {
            return redirect()->route('bookings.payment.show', $booking)
                ->with('success', 'Payment method saved. We will confirm your payment shortly.');
        }

        return $this->respond($request, $payment, 201, null, 'Payment record created.');
    }

    public function updateStatus(Request $request, Payment $payment): JsonResponse|RedirectResponse
    {
        $this->authorize('update', $payment);

        $validated = $request->validate([
            'status' => ['required', 'in:pending,paid,failed,refunded'],
            'transaction_ref' => ['nullable', 'string', 'max:255'],
        ]);

        $payment->update([
            'status' => $validated['status'],
            'transaction_ref' => $validated['transaction_ref'] ?? $payment->transaction_ref,
            'paid_at' => $validated['status'] === 'paid' ? now() : null,
        ]);

        if ($validated['status'] === 'paid' && $payment->booking->status === 'pending') {
            $payment->booking->update(['status' => 'confirmed']);
        }

        return $this->respond($request, $payment->fresh()->load('booking'), 200, null, 'Payment status updated.');
    }
}