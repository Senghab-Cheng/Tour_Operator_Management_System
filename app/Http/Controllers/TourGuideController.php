<?php

namespace App\Http\Controllers;

use App\Models\TourGuide;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TourGuideController extends Controller
{
    public function index(Request $request): JsonResponse|View
    {
        $query = TourGuide::query()->withCount('tourSchedules');

        if (! $request->user()?->isStaff()) {
            $query->active();
        }

        if ($request->user()?->isStaff() && $request->filled('status')) {
            $query->where('status', $request->status);
        }

        $guides = $query->latest()->paginate($request->routeIs('admin.*') ? 20 : 12);

        if ($request->wantsJson()) {
            return response()->json($guides);
        }

        if ($request->routeIs('admin.*')) {
            return view('admin.tour-guides.index', compact('guides'));
        }

        return view('tour-guides.index', compact('guides'));
    }

    public function show(Request $request, TourGuide $tourGuide): JsonResponse|View
    {
        $tourGuide->load([
            'tourSchedules' => fn ($q) => $q->where('status', 'scheduled')
                ->where('departure_date', '>=', now()->toDateString())
                ->with('tourPackage'),
        ]);

        if ($request->wantsJson()) {
            return response()->json($tourGuide);
        }

        return view('tour-guides.show', compact('tourGuide'));
    }

    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'bio' => ['nullable', 'string'],
            'skills' => ['nullable', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'max:4096'],
            'photo_path' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'in:active,inactive'],
        ]);

        $validated['status'] = $validated['status'] ?? 'active';
        $validated['photo'] = $this->imagePath($request, 'photo', $validated['photo_path'] ?? null);
        unset($validated['photo_path']);

        $guide = TourGuide::create($validated);

        return $this->respond($request, $guide, 201, route('tour-guides.show', $guide), 'Tour guide created.');
    }

    public function update(Request $request, TourGuide $tourGuide): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'bio' => ['nullable', 'string'],
            'skills' => ['nullable', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'max:4096'],
            'photo_path' => ['nullable', 'string', 'max:255'],
            'status' => ['sometimes', 'in:active,inactive'],
        ]);

        $validated['photo'] = $this->imagePath($request, 'photo', $validated['photo_path'] ?? $tourGuide->photo);
        unset($validated['photo_path']);

        $tourGuide->update($validated);

        return $this->respond($request, $tourGuide->fresh(), 200, null, 'Tour guide updated.');
    }

    public function destroy(Request $request, TourGuide $tourGuide): JsonResponse|RedirectResponse
    {
        $tourGuide->delete();

        return $this->respond($request, null, 204, route('tour-guides.index'), 'Tour guide deleted.');
    }

    private function imagePath(Request $request, string $field, ?string $fallback = null): ?string
    {
        if (! $request->hasFile($field)) {
            return $fallback;
        }

        return 'storage/'.$request->file($field)->store('tour-guides', 'public');
    }
}
