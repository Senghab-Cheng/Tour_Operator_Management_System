<?php

namespace App\Http\Controllers;

use App\Models\ItineraryItem;
use App\Models\TourPackage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ItineraryItemController extends Controller
{
    public function index(TourPackage $tourPackage): JsonResponse
    {
        return response()->json(
            $tourPackage->itineraryItems()->orderBy('day_number')->get()
        );
    }

    public function store(Request $request, TourPackage $tourPackage): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'day_number' => ['required', 'integer', 'min:1'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
        ]);

        $item = $tourPackage->itineraryItems()->create($validated);

        return $this->respond($request, $item, 201, null, 'Itinerary item added.');
    }

    public function update(Request $request, TourPackage $tourPackage, ItineraryItem $itineraryItem): JsonResponse|RedirectResponse
    {
        abort_unless($itineraryItem->tour_package_id === $tourPackage->id, 404);

        $validated = $request->validate([
            'day_number' => ['sometimes', 'integer', 'min:1'],
            'title' => ['sometimes', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
        ]);

        $itineraryItem->update($validated);

        return $this->respond($request, $itineraryItem->fresh(), 200, null, 'Itinerary item updated.');
    }

    public function destroy(Request $request, TourPackage $tourPackage, ItineraryItem $itineraryItem): JsonResponse|RedirectResponse
    {
        abort_unless($itineraryItem->tour_package_id === $tourPackage->id, 404);

        $itineraryItem->delete();

        return $this->respond($request, null, 204, null, 'Itinerary item deleted.');
    }
}
