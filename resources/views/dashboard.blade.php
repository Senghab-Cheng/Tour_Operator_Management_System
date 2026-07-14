<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="font-display text-2xl text-trail-900 mb-1">
                    Welcome back, {{ explode(' ', Auth::user()->name)[0] }}
                </h3>
                <p class="text-gray-500 text-sm">Here's what's coming up on your travels.</p>
            </div>

            <div class="grid sm:grid-cols-2 gap-6">
                <div class="bg-white shadow-sm rounded-lg p-6">
                    <p class="text-sm text-gray-400 mb-1">Total Bookings</p>
                    <p class="text-3xl font-display text-trail-900">{{ $totalBookings }}</p>
                </div>

                <div class="bg-white shadow-sm rounded-lg p-6">
                    @if ($upcoming)
                        <p class="text-sm text-gray-400 mb-1">Next Trip</p>
                        <p class="text-lg font-semibold text-trail-900">{{ $upcoming->tourSchedule->tourPackage->title }}</p>
                        <p class="text-sm text-gray-500">{{ $upcoming->tourSchedule->departure_date->format('D, M j Y') }}</p>
                    @else
                        <p class="text-sm text-gray-400 mb-1">Next Trip</p>
                        <p class="text-gray-500 text-sm">No upcoming trips yet.</p>
                    @endif
                </div>
            </div>

            @if ($upcoming)
                <div class="bg-trail-900 text-white rounded-lg p-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <p class="text-trail-400 text-xs uppercase tracking-wide mb-1">Coming up</p>
                        <h4 class="font-display text-xl mb-1">{{ $upcoming->tourSchedule->tourPackage->title }}</h4>
                        <p class="text-trail-100/80 text-sm">
                            {{ $upcoming->tourSchedule->departure_date->format('D, M j Y') }}
                            &middot; {{ $upcoming->number_of_people }} {{ Str::plural('person', $upcoming->number_of_people) }}
                        </p>
                    </div>
                    <a href="{{ route('bookings.index') }}"
                       class="inline-flex items-center justify-center px-5 py-2.5 bg-trail-500 rounded-full font-semibold text-sm hover:bg-trail-600 transition">
                        View Booking
                    </a>
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-lg p-6 flex flex-col sm:flex-row gap-3">
                <a href="{{ route('tour-packages.index') }}"
                   class="inline-flex items-center justify-center px-5 py-2.5 bg-trail-500 text-white rounded-full font-semibold text-sm hover:bg-trail-600 transition">
                    Browse Tours
                </a>
                <a href="{{ route('tour-guides.index') }}"
                   class="inline-flex items-center justify-center px-5 py-2.5 bg-white border border-trail-100 text-trail-900 rounded-full font-semibold text-sm hover:bg-trail-50 transition">
                    Meet the Guides
                </a>
                <a href="{{ route('profile.edit') }}"
                   class="inline-flex items-center justify-center px-5 py-2.5 bg-white border border-trail-100 text-trail-900 rounded-full font-semibold text-sm hover:bg-trail-50 transition">
                    Edit Profile
                </a>
            </div>
        </div>
    </div>
</x-app-layout>