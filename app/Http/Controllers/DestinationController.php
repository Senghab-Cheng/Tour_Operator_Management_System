<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DestinationController extends Controller
{
    public function index(Request $request): JsonResponse|View
    {
        $destinations = Destination::query()->latest()->paginate($request->routeIs('admin.*') ? 20 : 50);

        if ($request->wantsJson()) {
            return response()->json($destinations);
        }

        if ($request->routeIs('admin.*')) {
            return view('admin.destinations.index', compact('destinations'));
        }

        return view('destination', compact('destinations'));
    }

    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'discount' => ['nullable', 'string', 'max:50'],
            'image' => ['nullable', 'image', 'max:4096'],
            'image_path' => ['nullable', 'string', 'max:255'],
        ]);

        $validated['image_path'] = $this->imagePath($request, 'image', $validated['image_path'] ?? null);

        $destination = Destination::create($validated);

        return $this->respond($request, $destination, 201, route('admin.destinations.index'), 'Destination created.');
    }

    public function update(Request $request, Destination $destination): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'discount' => ['nullable', 'string', 'max:50'],
            'image' => ['nullable', 'image', 'max:4096'],
            'image_path' => ['nullable', 'string', 'max:255'],
        ]);

        $validated['image_path'] = $this->imagePath($request, 'image', $validated['image_path'] ?? $destination->image_path);

        $destination->update($validated);

        return $this->respond($request, $destination->fresh(), 200, route('admin.destinations.index'), 'Destination updated.');
    }

    public function destroy(Request $request, Destination $destination): JsonResponse|RedirectResponse
    {
        $destination->delete();

        return $this->respond($request, null, 204, route('admin.destinations.index'), 'Destination deleted.');
    }

    private function imagePath(Request $request, string $field, ?string $fallback = null): ?string
    {
        if (! $request->hasFile($field)) {
            return $fallback;
        }

        return 'storage/'.$request->file($field)->store('destinations', 'public');
    }
}
