<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tour Package') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-800 rounded-lg text-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($tourPackage->cover_image)
                    <img src="{{ asset($tourPackage->cover_image) }}" class="w-full h-48 object-cover rounded-lg mb-5" alt="{{ $tourPackage->title }}">
                @endif

                <form method="POST" action="{{ route('admin.tour-packages.update', $tourPackage) }}" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="title" value="Title" />
                        <x-text-input id="title" name="title" class="block w-full" value="{{ old('title', $tourPackage->title) }}" required autofocus />
                    </div>

                    <div>
                        <x-input-label for="destination" value="Destination" />
                        <x-text-input id="destination" name="destination" class="block w-full" value="{{ old('destination', $tourPackage->destination) }}" required />
                    </div>

                    <div>
                        <x-input-label for="description" value="Description" />
                        <textarea id="description" name="description" rows="4"
                                  class="w-full rounded-lg border-trail-100 bg-trail-50/60 focus:border-trail-500 focus:ring-trail-500">{{ old('description', $tourPackage->description) }}</textarea>
                    </div>

                    <div class="grid sm:grid-cols-3 gap-4">
                        <div>
                            <x-input-label for="price" value="Price (USD)" />
                            <x-text-input id="price" name="price" type="number" step="0.01" min="0" class="block w-full" value="{{ old('price', $tourPackage->price) }}" required />
                        </div>
                        <div>
                            <x-input-label for="duration_days" value="Days" />
                            <x-text-input id="duration_days" name="duration_days" type="number" min="1" class="block w-full" value="{{ old('duration_days', $tourPackage->duration_days) }}" required />
                        </div>
                        <div>
                            <x-input-label for="duration_nights" value="Nights" />
                            <x-text-input id="duration_nights" name="duration_nights" type="number" min="0" class="block w-full" value="{{ old('duration_nights', $tourPackage->duration_nights) }}" required />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="cover_image" value="Replace Cover Image" />
                        <input id="cover_image" name="cover_image" type="file" accept="image/*"
                               class="block w-full text-sm text-gray-600 file:mr-3 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-trail-500 file:text-white file:text-sm file:font-semibold hover:file:bg-trail-600">
                        <p class="text-xs text-gray-400 mt-1">Optional. Leave blank to keep the current image.</p>
                    </div>

                    <div>
                        <x-input-label for="status" value="Status" />
                        <select id="status" name="status" class="w-full rounded-lg border-trail-100 bg-trail-50/60 focus:border-trail-500 focus:ring-trail-500">
                            <option value="active" @selected(old('status', $tourPackage->status) === 'active')>Active (visible to travelers)</option>
                            <option value="inactive" @selected(old('status', $tourPackage->status) === 'inactive')>Inactive (hidden / draft)</option>
                        </select>
                    </div>

                    <div class="flex items-center justify-between pt-2">
                        <div class="flex gap-3">
                            <x-primary-button class="w-auto px-6">Save Changes</x-primary-button>
                            <a href="{{ route('tour-packages.show', $tourPackage) }}" class="inline-flex items-center px-6 py-2.5 text-sm text-gray-500 hover:text-gray-700">
                                Cancel
                            </a>
                        </div>

                        <form method="POST" action="{{ route('admin.tour-packages.destroy', $tourPackage) }}"
                              onsubmit="return confirm('Delete this tour package? This cannot be undone.');">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-sm text-red-600 hover:text-red-800">Delete Tour</button>
                        </form>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>