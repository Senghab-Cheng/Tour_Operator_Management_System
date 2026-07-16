<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage Tour Guides</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @include('admin.partials.nav')
            @include('admin.partials.alerts')

            <section class="admin-card p-6">
                <h3 class="admin-section-title">Add Tour Guide</h3>
                <form method="POST" action="{{ route('admin.tour-guides.store') }}" enctype="multipart/form-data" class="grid md:grid-cols-2 gap-4">
                    @csrf
                    <input name="name" value="{{ old('name') }}" class="admin-input" placeholder="Guide name" required>
                    <input name="email" value="{{ old('email') }}" type="email" class="admin-input" placeholder="Email">
                    <input name="phone" value="{{ old('phone') }}" class="admin-input" placeholder="Phone">
                    <input name="skills" value="{{ old('skills') }}" class="admin-input" placeholder="Skills, comma separated">
                    <div>
                        <label class="admin-label">Profile photo</label>
                        <input name="photo" type="file" accept="image/*" class="admin-input file:mr-3 file:rounded-md file:border-0 file:bg-trail-500 file:px-3 file:py-1.5 file:text-sm file:font-semibold file:text-white">
                    </div>
                    <select name="status" class="admin-input">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    <input name="photo_path" value="{{ old('photo_path') }}" class="admin-input md:col-span-2" placeholder="Or image path, e.g. img/about.jpg">
                    <textarea name="bio" class="md:col-span-2 admin-input" rows="4" placeholder="Bio">{{ old('bio') }}</textarea>
                    <div class="md:col-span-2">
                        <button type="submit" class="admin-btn-primary">Save Guide</button>
                    </div>
                </form>
            </section>

            <section class="grid md:grid-cols-2 xl:grid-cols-3 gap-4">
                @forelse ($guides as $guide)
                    <div class="admin-card p-5">
                        <div class="flex items-center gap-4 mb-4">
                            <img src="{{ $guide->photo ? asset($guide->photo) : asset('img/about.jpg') }}" class="w-16 h-16 rounded-full object-cover border-2 border-trail-200" alt="{{ $guide->name }}">
                            <div>
                                <h4 class="font-semibold text-gray-900">{{ $guide->name }}</h4>
                                <p class="text-sm text-gray-500">{{ $guide->status }} · {{ $guide->tour_schedules_count }} trips</p>
                            </div>
                        </div>

                        <details>
                            <summary class="admin-summary">Edit Guide</summary>
                            <form method="POST" action="{{ route('admin.tour-guides.update', $guide) }}" enctype="multipart/form-data" class="grid gap-3 mt-4">
                                @csrf
                                @method('PUT')
                                <input name="name" value="{{ old('name', $guide->name) }}" class="admin-input" required>
                                <input name="email" value="{{ old('email', $guide->email) }}" type="email" class="admin-input" placeholder="Email">
                                <input name="phone" value="{{ old('phone', $guide->phone) }}" class="admin-input" placeholder="Phone">
                                <input name="skills" value="{{ old('skills', $guide->skills) }}" class="admin-input" placeholder="Skills">
                                <input name="photo" type="file" accept="image/*" class="admin-input file:mr-3 file:rounded-md file:border-0 file:bg-trail-500 file:px-3 file:py-1.5 file:text-sm file:font-semibold file:text-white">
                                <input name="photo_path" value="{{ old('photo_path', $guide->photo) }}" class="admin-input" placeholder="Existing image path">
                                <select name="status" class="admin-input">
                                    <option value="active" @selected($guide->status === 'active')>Active</option>
                                    <option value="inactive" @selected($guide->status === 'inactive')>Inactive</option>
                                </select>
                                <textarea name="bio" class="admin-input" rows="4">{{ old('bio', $guide->bio) }}</textarea>
                                <button type="submit" class="admin-btn-primary">Update Guide</button>
                            </form>
                            <form method="POST" action="{{ route('admin.tour-guides.destroy', $guide) }}" class="mt-3" onsubmit="return confirm('Delete this guide?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="admin-btn-danger">Delete Guide</button>
                            </form>
                        </details>
                    </div>
                @empty
                    <p class="text-gray-500 col-span-full">No guides have been added yet.</p>
                @endforelse
            </section>

            {{ $guides->links() }}
        </div>
    </div>
</x-app-layout>
