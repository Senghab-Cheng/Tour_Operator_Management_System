<x-app-layout>
    <div class="py-10">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-trail-900 rounded-2xl p-8 text-white relative overflow-hidden">
                <div class="absolute -right-10 -top-10 w-40 h-40 rounded-full bg-trail-500/10"></div>
                <p class="text-trail-400 text-xs uppercase tracking-widest mb-2">Team</p>
                <h3 class="font-display text-3xl mb-1">Edit {{ $tourGuide->name }}</h3>
            </div>

            <div class="bg-white shadow-sm rounded-2xl p-6">
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl text-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($tourGuide->photo)
                    <img src="{{ asset($tourGuide->photo) }}" class="w-24 h-24 rounded-full object-cover mb-5" alt="{{ $tourGuide->name }}">
                @endif

                <form method="POST" action="{{ route('admin.tour-guides.update', $tourGuide) }}" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="name" value="Name" />
                        <x-text-input id="name" name="name" class="block w-full" value="{{ old('name', $tourGuide->name) }}" required autofocus />
                    </div>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="phone" value="Phone" />
                            <x-text-input id="phone" name="phone" class="block w-full" value="{{ old('phone', $tourGuide->phone) }}" />
                        </div>
                        <div>
                            <x-input-label for="email" value="Email" />
                            <x-text-input id="email" name="email" type="email" class="block w-full" value="{{ old('email', $tourGuide->email) }}" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="skills" value="Skills (comma-separated)" />
                        <x-text-input id="skills" name="skills" class="block w-full" value="{{ old('skills', $tourGuide->skills) }}" placeholder="e.g. Hiking, French, First Aid" />
                    </div>

                    <div>
                        <x-input-label for="bio" value="Bio" />
                        <textarea id="bio" name="bio" rows="4"
                                  class="w-full rounded-lg border-trail-100 bg-trail-50/60 focus:border-trail-500 focus:ring-trail-500">{{ old('bio', $tourGuide->bio) }}</textarea>
                    </div>

                    <div>
                        <x-input-label for="photo" value="Replace Photo" />
                        <input id="photo" name="photo" type="file" accept="image/*"
                               class="block w-full text-sm text-gray-600 file:mr-3 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-trail-500 file:text-white file:text-sm file:font-semibold hover:file:bg-trail-600">
                    </div>

                    <div>
                        <x-input-label for="status" value="Status" />
                        <select id="status" name="status" class="w-full rounded-lg border-trail-100 bg-trail-50/60 focus:border-trail-500 focus:ring-trail-500">
                            <option value="active" @selected(old('status', $tourGuide->status) === 'active')>Active</option>
                            <option value="inactive" @selected(old('status', $tourGuide->status) === 'inactive')>Inactive</option>
                        </select>
                    </div>

                    <div class="flex items-center justify-between pt-2">
                        <div class="flex gap-3">
                            <x-primary-button class="w-auto px-6">Save Changes</x-primary-button>
                            <a href="{{ route('tour-guides.show', $tourGuide) }}" class="inline-flex items-center px-6 py-2.5 text-sm text-gray-500 hover:text-gray-700">
                                Cancel
                            </a>
                        </div>

                        <form method="POST" action="{{ route('admin.tour-guides.destroy', $tourGuide) }}"
                              onsubmit="return confirm('Remove this guide?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-sm text-red-600 hover:text-red-800">Remove Guide</button>
                        </form>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>