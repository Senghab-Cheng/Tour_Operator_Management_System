<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VehicleController extends Controller
{
    public function index(Request $request): JsonResponse|View
    {
        $query = Vehicle::query()->withCount('tourSchedules');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $vehicles = $query->latest()->paginate(15);

        if ($request->wantsJson()) {
            return response()->json($vehicles);
        }

        return view('admin.vehicles.index', compact('vehicles'));
    }

    public function show(Vehicle $vehicle): JsonResponse
    {
        $vehicle->load(['tourSchedules.tourPackage']);

        return response()->json($vehicle);
    }

    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'type' => ['required', 'in:tuktuk,car,van,bus'],
            'plate_number' => ['required', 'string', 'max:50', 'unique:vehicles,plate_number'],
            'capacity' => ['required', 'integer', 'min:1'],
            'driver_name' => ['nullable', 'string', 'max:255'],
            'driver_phone' => ['nullable', 'string', 'max:50'],
            'status' => ['nullable', 'in:available,in_use,maintenance'],
        ]);

        $validated['status'] = $validated['status'] ?? 'available';

        $vehicle = Vehicle::create($validated);

        return $this->respond($request, $vehicle, 201, null, 'Vehicle created.');
    }

    public function update(Request $request, Vehicle $vehicle): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'type' => ['sometimes', 'in:tuktuk,car,van,bus'],
            'plate_number' => ['sometimes', 'string', 'max:50', 'unique:vehicles,plate_number,'.$vehicle->id],
            'capacity' => ['sometimes', 'integer', 'min:1'],
            'driver_name' => ['nullable', 'string', 'max:255'],
            'driver_phone' => ['nullable', 'string', 'max:50'],
            'status' => ['sometimes', 'in:available,in_use,maintenance'],
        ]);

        $vehicle->update($validated);

        return $this->respond($request, $vehicle->fresh(), 200, null, 'Vehicle updated.');
    }

    public function destroy(Request $request, Vehicle $vehicle): JsonResponse|RedirectResponse
    {
        $vehicle->delete();

        return $this->respond($request, null, 204, null, 'Vehicle deleted.');
    }
}
