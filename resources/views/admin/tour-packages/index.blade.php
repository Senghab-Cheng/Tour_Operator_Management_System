<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage Tours</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @include('admin.partials.nav')
            @include('admin.partials.alerts')

            <section class="admin-card p-6">
                <h3 class="admin-section-title">Add Tour Package</h3>
                <form method="POST" action="{{ route('admin.tour-packages.store') }}" enctype="multipart/form-data" class="grid md:grid-cols-2 gap-4">
                    @csrf
                    <input name="title" value="{{ old('title') }}" class="admin-input" placeholder="Tour title" required>
                    <input name="destination" value="{{ old('destination') }}" class="admin-input" placeholder="Destination" required>
                    <input name="price" value="{{ old('price') }}" type="number" min="0" step="0.01" class="admin-input" placeholder="Price" required>
                    <div class="grid grid-cols-2 gap-3">
                        <input name="duration_days" value="{{ old('duration_days') }}" type="number" min="1" class="admin-input" placeholder="Days" required>
                        <input name="duration_nights" value="{{ old('duration_nights') }}" type="number" min="0" class="admin-input" placeholder="Nights" required>
                    </div>
                    <input name="slug" value="{{ old('slug') }}" class="admin-input" placeholder="Custom slug (optional)">
                    <select name="status" class="admin-input">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    <div>
                        <label class="admin-label">Cover image</label>
                        <input name="cover_image" type="file" accept="image/*" class="admin-input file:mr-3 file:rounded-md file:border-0 file:bg-trail-500 file:px-3 file:py-1.5 file:text-sm file:font-semibold file:text-white">
                    </div>
                    <input name="cover_image_path" value="{{ old('cover_image_path') }}" class="admin-input" placeholder="Or image path, e.g. img/destination-1.jpg">
                    <textarea name="description" class="md:col-span-2 admin-input" rows="4" placeholder="Tour details">{{ old('description') }}</textarea>
                    <div class="md:col-span-2">
                        <button type="submit" class="admin-btn-primary">Save Tour</button>
                    </div>
                </form>
            </section>

            <section class="admin-card overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="admin-section-title mb-0">Tours From Database</h3>
                </div>

                <div class="divide-y divide-gray-100">
                    @forelse ($packages as $package)
                        <details class="p-6 group">
                            <summary class="cursor-pointer list-none flex flex-col md:flex-row md:items-center gap-4">
                                <img src="{{ $package->cover_image ? asset($package->cover_image) : asset('img/destination-1.jpg') }}" class="w-24 h-16 rounded-md object-cover" alt="{{ $package->title }}">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900">{{ $package->title }}</h4>
                                    <p class="text-sm text-gray-500">{{ $package->destination }} · ${{ number_format($package->price, 2) }} · {{ $package->status }}</p>
                                </div>
                                <span class="admin-summary group-open:hidden">Edit Tour</span>
                            </summary>

                            <div class="mt-6 grid lg:grid-cols-2 gap-6">
                                <form method="POST" action="{{ route('admin.tour-packages.update', $package) }}" enctype="multipart/form-data" class="grid gap-3">
                                    @csrf
                                    @method('PUT')
                                    <input name="title" value="{{ old('title', $package->title) }}" class="admin-input" required>
                                    <input name="destination" value="{{ old('destination', $package->destination) }}" class="admin-input" required>
                                    <div class="grid grid-cols-3 gap-3">
                                        <input name="price" value="{{ old('price', $package->price) }}" type="number" min="0" step="0.01" class="admin-input" required>
                                        <input name="duration_days" value="{{ old('duration_days', $package->duration_days) }}" type="number" min="1" class="admin-input" required>
                                        <input name="duration_nights" value="{{ old('duration_nights', $package->duration_nights) }}" type="number" min="0" class="admin-input" required>
                                    </div>
                                    <input name="slug" value="{{ old('slug', $package->slug) }}" class="admin-input" required>
                                    <select name="status" class="admin-input">
                                        <option value="active" @selected($package->status === 'active')>Active</option>
                                        <option value="inactive" @selected($package->status === 'inactive')>Inactive</option>
                                    </select>
                                    <input name="cover_image" type="file" accept="image/*" class="admin-input file:mr-3 file:rounded-md file:border-0 file:bg-trail-500 file:px-3 file:py-1.5 file:text-sm file:font-semibold file:text-white">
                                    <input name="cover_image_path" value="{{ old('cover_image_path', $package->cover_image) }}" class="admin-input" placeholder="Existing image path">
                                    <textarea name="description" class="admin-input" rows="4">{{ old('description', $package->description) }}</textarea>
                                    <button type="submit" class="admin-btn-primary">Update Tour</button>
                                </form>

                                <div class="space-y-4">
                                    <form method="POST" action="{{ route('admin.itinerary.store', $package) }}" class="grid gap-3 bg-gray-50 rounded-xl p-4 border border-gray-200">
                                        @csrf
                                        <h5 class="font-semibold text-gray-900">Add Itinerary Item</h5>
                                        <input name="day_number" type="number" min="1" class="admin-input" placeholder="Day number" required>
                                        <input name="title" class="admin-input" placeholder="Item title" required>
                                        <input name="location" class="admin-input" placeholder="Location">
                                        <textarea name="description" class="admin-input" rows="2" placeholder="Description"></textarea>
                                        <button type="submit" class="admin-btn-secondary">Add Item</button>
                                    </form>

                                    @foreach ($package->itineraryItems as $item)
                                        <form method="POST" action="{{ route('admin.itinerary.update', [$package, $item]) }}" class="grid gap-2 border border-gray-200 rounded-xl p-3">
                                            @csrf
                                            @method('PUT')
                                            <div class="grid grid-cols-4 gap-2">
                                                <input name="day_number" value="{{ $item->day_number }}" type="number" min="1" class="admin-input" required>
                                                <input name="title" value="{{ $item->title }}" class="col-span-3 admin-input" required>
                                            </div>
                                            <input name="location" value="{{ $item->location }}" class="admin-input" placeholder="Location">
                                            <textarea name="description" class="admin-input" rows="2">{{ $item->description }}</textarea>
                                            <button type="submit" class="admin-btn-outline">Update Item</button>
                                        </form>
                                    @endforeach
                                </div>
                            </div>

                            <form method="POST" action="{{ route('admin.tour-packages.destroy', $package) }}" class="mt-4" onsubmit="return confirm('Delete this tour package?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="admin-btn-danger">Delete Tour Package</button>
                            </form>
                        </details>
                    @empty
                        <p class="p-6 text-gray-500">No tour packages have been added yet.</p>
                    @endforelse
                </div>
            </section>

            {{ $packages->links() }}
        </div>
    </div>
</x-app-layout>
