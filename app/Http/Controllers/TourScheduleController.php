<?php

namespace App\Http\Controllers;

use App\Models\TourGuide;
use App\Models\TourPackage;
use App\Models\TourSchedule;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TourScheduleController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = TourSchedule::query()
            ->with(['tourPackage', 'tourGuide', 'vehicle']);

        if ($request->filled('tour_package_id')) {
            $query->where('tour_package_id', $request->tour_package_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('from_date')) {
            $query->where('departure_date', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->where('departure_date', '<=', $request->to_date);
        }

        if (! $request->user()?->isStaff()) {
            $query->where('status', 'scheduled')
                ->where('departure_date', '>=', now()->toDateString());
        }

        return response()->json($query->orderBy('departure_date')->paginate(15));
    }

    public function byPackage(TourPackage $tourPackage): JsonResponse
    {
        $schedules = $tourPackage->tourSchedules()
            ->with(['tourGuide', 'vehicle'])
            ->where('status', 'scheduled')
            ->where('departure_date', '>=', now()->toDateString())
            ->orderBy('departure_date')
            ->get()
            ->map(fn (TourSchedule $schedule) => array_merge($schedule->toArray(), [
                'seats_available' => $schedule->seatsAvailable(),
            ]));

        return response()->json($schedules);
    }

    public function show(TourSchedule $tourSchedule): JsonResponse
    {
        $tourSchedule->load(['tourPackage', 'tourGuide', 'vehicle', 'bookings.user']);

        return response()->json(array_merge($tourSchedule->toArray(), [
            'seats_available' => $tourSchedule->seatsAvailable(),
        ]));
    }

    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'tour_package_id' => ['required', 'exists:tour_packages,id'],
            'tour_guide_id' => ['nullable', 'exists:tour_guides,id'],
            'vehicle_id' => ['nullable', 'exists:vehicles,id'],
            'departure_date' => ['required', 'date', 'after_or_equal:today'],
            'pickup_point' => ['nullable', 'string', 'max:255'],
            'pickup_time' => ['nullable', 'date_format:H:i'],
            'max_seats' => ['required', 'integer', 'min:1'],
            'status' => ['nullable', 'in:scheduled,ongoing,completed,cancelled'],
        ]);

        $validated['seats_booked'] = 0;
        $validated['status'] = $validated['status'] ?? 'scheduled';

        $schedule = TourSchedule::create($validated);
        $schedule->load(['tourPackage', 'tourGuide', 'vehicle']);

        return $this->respond($request, $schedule, 201, null, 'Tour schedule created.');
    }

    public function update(Request $request, TourSchedule $tourSchedule): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'tour_guide_id' => ['nullable', 'exists:tour_guides,id'],
            'vehicle_id' => ['nullable', 'exists:vehicles,id'],
            'departure_date' => ['sometimes', 'date'],
            'pickup_point' => ['nullable', 'string', 'max:255'],
            'pickup_time' => ['nullable', 'date_format:H:i'],
            'max_seats' => ['sometimes', 'integer', 'min:'.$tourSchedule->seats_booked],
            'status' => ['sometimes', 'in:scheduled,ongoing,completed,cancelled'],
        ]);

        $tourSchedule->update($validated);

        return $this->respond($request, $tourSchedule->fresh()->load(['tourPackage', 'tourGuide', 'vehicle']), 200, null, 'Tour schedule updated.');
    }

    public function destroy(Request $request, TourSchedule $tourSchedule): JsonResponse|RedirectResponse
    {
        if ($tourSchedule->seats_booked > 0) {
            return $this->respond($request, ['message' => 'Cannot delete a schedule with active bookings.'], 422);
        }

        $tourSchedule->delete();

        return $this->respond($request, null, 204, null, 'Tour schedule deleted.');
    }

    public function trip(TourSchedule $tourSchedule): View
    {
        $tourSchedule->load([
            'tourPackage',
            'tourGuide',
            'vehicle',
            'bookings.user',
            'comments' => fn ($q) => $q->latest()->with('postedBy'),
        ]);

        $guides = TourGuide::active()->orderBy('name')->get();

        return view('trips.show', compact('tourSchedule', 'guides'));
    }
}