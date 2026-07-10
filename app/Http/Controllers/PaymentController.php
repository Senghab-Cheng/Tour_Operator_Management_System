<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function show(Payment $payment): JsonResponse
    {
        $payment->load(['booking.user', 'booking.tourSchedule.tourPackage']);

        return response()->json($payment);
    }

    public function store(Request $request, Booking $booking): JsonResponse|RedirectResponse
    {
        if ($booking->payment) {
            return $this->respond($request, ['message' => 'Payment already exists for this booking.'], 422);
        }

        $validated = $request->validate([
            'method' => ['required', 'in:cash,card,bank_transfer,aba,wing'],
            'transaction_ref' => ['nullable', 'string', 'max:255'],
        ]);

        $payment = Payment::create([
            'booking_id' => $booking->id,
            'amount' => $booking->total_price,
            'method' => $validated['method'],
            'status' => 'pending',
            'transaction_ref' => $validated['transaction_ref'] ?? null,
        ]);

        return $this->respond($request, $payment, 201, null, 'Payment record created.');
    }

    public function updateStatus(Request $request, Payment $payment): JsonResponse|RedirectResponse
    {
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
