<?php

namespace App\Http\Controllers;

use App\Models\TourGuide;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TourGuideController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = TourGuide::query()->withCount('tourSchedules');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        return response()->json($query->latest()->paginate(15));
    }

    public function show(TourGuide $tourGuide): JsonResponse
    {
        $tourGuide->load(['tourSchedules.tourPackage']);

        return response()->json($tourGuide);
    }

    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'bio' => ['nullable', 'string'],
            'photo' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'in:active,inactive'],
        ]);

        $validated['status'] = $validated['status'] ?? 'active';

        $guide = TourGuide::create($validated);

        return $this->respond($request, $guide, 201, null, 'Tour guide created.');
    }

    public function update(Request $request, TourGuide $tourGuide): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'bio' => ['nullable', 'string'],
            'photo' => ['nullable', 'string', 'max:255'],
            'status' => ['sometimes', 'in:active,inactive'],
        ]);

        $tourGuide->update($validated);

        return $this->respond($request, $tourGuide->fresh(), 200, null, 'Tour guide updated.');
    }

    public function destroy(Request $request, TourGuide $tourGuide): JsonResponse|RedirectResponse
    {
        $tourGuide->delete();

        return $this->respond($request, null, 204, null, 'Tour guide deleted.');
    }
}
