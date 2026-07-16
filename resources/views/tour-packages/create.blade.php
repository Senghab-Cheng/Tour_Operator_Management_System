<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Tour Package') }}
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

                <form method="POST" action="{{ route('admin.tour-packages.store') }}" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    <div>
                        <x-input-label for="title" value="Title" />
                        <x-text-input id="title" name="title" class="block w-full" value="{{ old('title') }}" required autofocus />
                    </div>

                    <div>
                        <x-input-label for="destination" value="Destination" />
                        <x-text-input id="destination" name="destination" class="block w-full" value="{{ old('destination') }}" required />
                    </div>

                    <div>
                        <x-input-label for="description" value="Description" />
                        <textarea id="description" name="description" rows="4"
                                  class="w-full rounded-lg border-trail-100 bg-trail-50/60 focus:border-trail-500 focus:ring-trail-500">{{ old('description') }}</textarea>
                    </div>

                    <div class="grid sm:grid-cols-3 gap-4">
                        <div>
                            <x-input-label for="price" value="Price (USD)" />
                            <x-text-input id="price" name="price" type="number" step="0.01" min="0" class="block w-full" value="{{ old('price') }}" required />
                        </div>
                        <div>
                            <x-input-label for="duration_days" value="Days" />
                            <x-text-input id="duration_days" name="duration_days" type="number" min="1" class="block w-full" value="{{ old('duration_days') }}" required />
                        </div>
                        <div>
                            <x-input-label for="duration_nights" value="Nights" />
                            <x-text-input id="duration_nights" name="duration_nights" type="number" min="0" class="block w-full" value="{{ old('duration_nights') }}" required />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="cover_image" value="Cover Image" />
                        <input id="cover_image" name="cover_image" type="file" accept="image/*"
                               class="block w-full text-sm text-gray-600 file:mr-3 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-trail-500 file:text-white file:text-sm file:font-semibold hover:file:bg-trail-600">
                        <p class="text-xs text-gray-400 mt-1">Optional. Leave blank to use a default image.</p>
                    </div>

                    <div>
                        <x-input-label for="status" value="Status" />
                        <select id="status" name="status" class="w-full rounded-lg border-trail-100 bg-trail-50/60 focus:border-trail-500 focus:ring-trail-500">
                            <option value="active" selected>Active (visible to travelers)</option>
                            <option value="inactive">Inactive (hidden / draft)</option>
                        </select>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <x-primary-button class="w-auto px-6">Create Tour Package</x-primary-button>
                        <a href="{{ route('tour-packages.index') }}" class="inline-flex items-center px-6 py-2.5 text-sm text-gray-500 hover:text-gray-700">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>