<x-app-layout>
    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-trail-900 rounded-2xl p-8 text-white relative overflow-hidden">
                <div class="absolute -right-10 -top-10 w-40 h-40 rounded-full bg-trail-500/10"></div>
                <div class="absolute -right-2 top-16 w-20 h-20 rounded-full bg-trail-500/10"></div>
                <p class="text-trail-400 text-xs uppercase tracking-widest mb-2">Welcome back</p>
                <h3 class="font-display text-3xl mb-1">{{ explode(' ', Auth::user()->name)[0] }}</h3>
                <p class="text-trail-100/70 text-sm">Here's what's coming up on your travels.</p>
            </div>

            <div class="grid sm:grid-cols-2 gap-6">
                <div class="bg-white shadow-sm rounded-2xl p-6 border border-trail-100/60">
                    <p class="text-sm text-gray-400 mb-1">Total Bookings</p>
                    <p class="text-3xl font-display text-trail-900">{{ $totalBookings }}</p>
                </div>

                <div class="bg-white shadow-sm rounded-2xl p-6 border border-trail-100/60">
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
                <div class="bg-white border border-trail-100 rounded-2xl p-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 shadow-sm">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-trail-50 flex items-center justify-center text-trail-500 text-xl">
                            ✈
                        </div>
                        <div>
                            <p class="text-trail-500 text-xs uppercase tracking-wide mb-1">Coming up</p>
                            <h4 class="font-display text-lg text-trail-900">{{ $upcoming->tourSchedule->tourPackage->title }}</h4>
                            <p class="text-gray-500 text-sm">
                                {{ $upcoming->tourSchedule->departure_date->format('D, M j Y') }}
                                &middot; {{ $upcoming->number_of_people }} {{ Str::plural('person', $upcoming->number_of_people) }}
                            </p>
                        </div>
                    </div>
                    <a href="{{ route('bookings.index') }}"
                       class="inline-flex items-center justify-center px-5 py-2.5 bg-trail-500 text-white rounded-full font-semibold text-sm hover:bg-trail-600 transition whitespace-nowrap">
                        View Booking
                    </a>
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-2xl p-6 border border-trail-100/60 flex flex-col sm:flex-row gap-3">
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