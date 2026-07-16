<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage Destinations</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @include('admin.partials.nav')
            @include('admin.partials.alerts')

            <section class="admin-card p-6">
                <h3 class="admin-section-title">Add Destination</h3>
                <form method="POST" action="{{ route('admin.destinations.store') }}" enctype="multipart/form-data" class="grid md:grid-cols-2 gap-4">
                    @csrf
                    <div>
                        <label class="admin-label" for="add-name">Place name</label>
                        <input id="add-name" name="name" value="{{ old('name') }}" class="admin-input" placeholder="e.g. Siem Reap" required>
                    </div>
                    <div>
                        <label class="admin-label" for="add-discount">Discount label</label>
                        <input id="add-discount" name="discount" value="{{ old('discount') }}" class="admin-input" placeholder="e.g. 30% OFF">
                    </div>
                    <div>
                        <label class="admin-label" for="add-image">Destination image</label>
                        <input id="add-image" name="image" type="file" accept="image/*" class="admin-input file:mr-3 file:rounded-md file:border-0 file:bg-trail-500 file:px-3 file:py-1.5 file:text-sm file:font-semibold file:text-white hover:file:bg-trail-600">
                    </div>
                    <div>
                        <label class="admin-label" for="add-image-path">Or image path</label>
                        <input id="add-image-path" name="image_path" value="{{ old('image_path') }}" class="admin-input" placeholder="e.g. img/destination-1.jpg">
                    </div>
                    <div class="md:col-span-2">
                        <button type="submit" class="admin-btn-primary">Save Destination</button>
                    </div>
                </form>
            </section>

            <section class="grid md:grid-cols-2 xl:grid-cols-3 gap-4">
                @forelse ($destinations as $destination)
                    <div class="admin-card overflow-hidden">
                        <img src="{{ $destination->image_path ? asset($destination->image_path) : asset('img/destination-1.jpg') }}"
                             class="w-full h-44 object-cover"
                             alt="{{ $destination->name }}">
                        <div class="p-5">
                            <h4 class="font-semibold text-gray-900 text-lg">{{ $destination->name }}</h4>
                            @if ($destination->discount)
                                <span class="inline-block mt-2 px-2.5 py-1 rounded-md bg-red-50 text-red-700 text-xs font-bold border border-red-200">{{ $destination->discount }}</span>
                            @endif

                            <details class="mt-4">
                                <summary class="admin-summary">Edit Destination</summary>
                                <form method="POST" action="{{ route('admin.destinations.update', $destination) }}" enctype="multipart/form-data" class="grid gap-3 mt-4">
                                    @csrf
                                    @method('PUT')
                                    <div>
                                        <label class="admin-label">Place name</label>
                                        <input name="name" value="{{ old('name', $destination->name) }}" class="admin-input" required>
                                    </div>
                                    <div>
                                        <label class="admin-label">Discount label</label>
                                        <input name="discount" value="{{ old('discount', $destination->discount) }}" class="admin-input" placeholder="e.g. 30% OFF">
                                    </div>
                                    <div>
                                        <label class="admin-label">Replace image</label>
                                        <input name="image" type="file" accept="image/*" class="admin-input file:mr-3 file:rounded-md file:border-0 file:bg-trail-500 file:px-3 file:py-1.5 file:text-sm file:font-semibold file:text-white">
                                    </div>
                                    <div>
                                        <label class="admin-label">Current image path</label>
                                        <input name="image_path" value="{{ old('image_path', $destination->image_path) }}" class="admin-input">
                                    </div>
                                    <div class="flex flex-wrap gap-2 pt-1">
                                        <button type="submit" class="admin-btn-primary">Update Destination</button>
                                    </div>
                                </form>
                                <form method="POST" action="{{ route('admin.destinations.destroy', $destination) }}" class="mt-3" onsubmit="return confirm('Delete this destination?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="admin-btn-danger">Delete Destination</button>
                                </form>
                            </details>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 col-span-full">No destinations have been added yet.</p>
                @endforelse
            </section>

            {{ $destinations->links() }}
        </div>
    </div>
</x-app-layout>
