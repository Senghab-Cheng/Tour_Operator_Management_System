<?php

namespace App\Http\Controllers;

use App\Models\TourPackage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TourPackageController extends Controller
{
    public function index(Request $request): JsonResponse|View
    {
        $query = TourPackage::query()
            ->withCount('tourSchedules')
            ->withAvg('reviews', 'rating');

        if (! $request->user()?->isStaff()) {
            $query->where('status', 'active');
        }

        if ($request->filled('destination')) {
            $query->where('destination', 'like', '%'.$request->destination.'%');
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%'.$request->search.'%')
                    ->orWhere('destination', 'like', '%'.$request->search.'%');
            });
        }

        $packages = $query->latest()->paginate(12);

        if ($request->wantsJson()) {
            return response()->json($packages);
        }

        return view('tour-packages.index', compact('packages'));
    }

    public function show(Request $request, TourPackage $tourPackage): JsonResponse|View
    {
        if ($tourPackage->status !== 'active' && ! $request->user()?->isStaff()) {
            abort(404);
        }

        $tourPackage->load([
            'itineraryItems',
            'tourSchedules' => fn ($q) => $q->where('status', 'scheduled')
                ->where('departure_date', '>=', now()->toDateString())
                ->with(['tourGuide', 'vehicle']),
            'reviews.user',
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'package' => $tourPackage,
                'average_rating' => $tourPackage->averageRating(),
            ]);
        }

        return view('tour-packages.show', compact('tourPackage'));
    }

    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:tour_packages,slug'],
            'destination' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'duration_days' => ['required', 'integer', 'min:1'],
            'duration_nights' => ['required', 'integer', 'min:0'],
            'cover_image' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'in:active,inactive'],
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);
        $validated['status'] = $validated['status'] ?? 'active';

        $package = TourPackage::create($validated);

        return $this->respond($request, $package, 201, route('tour-packages.show', $package), 'Tour package created.');
    }

    public function update(Request $request, TourPackage $tourPackage): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['sometimes', 'string', 'max:255'],
            'slug' => ['sometimes', 'string', 'max:255', 'unique:tour_packages,slug,'.$tourPackage->id],
            'destination' => ['sometimes', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['sometimes', 'numeric', 'min:0'],
            'duration_days' => ['sometimes', 'integer', 'min:1'],
            'duration_nights' => ['sometimes', 'integer', 'min:0'],
            'cover_image' => ['nullable', 'string', 'max:255'],
            'status' => ['sometimes', 'in:active,inactive'],
        ]);

        $tourPackage->update($validated);

        return $this->respond($request, $tourPackage->fresh(), 200, null, 'Tour package updated.');
    }

    public function destroy(Request $request, TourPackage $tourPackage): JsonResponse|RedirectResponse
    {
        $tourPackage->delete();

        return $this->respond($request, null, 204, route('tour-packages.index'), 'Tour package deleted.');
    }
}