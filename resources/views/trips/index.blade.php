<x-app-layout>
    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-trail-900 rounded-2xl p-8 text-white relative overflow-hidden">
                <div class="absolute -right-10 -top-10 w-40 h-40 rounded-full bg-trail-500/10"></div>
                <p class="text-trail-400 text-xs uppercase tracking-widest mb-2">Operations</p>
                <h3 class="font-display text-3xl mb-1">All Trips</h3>
                <p class="text-trail-100/70 text-sm">Manage departures, attendance, and guide comments.</p>
            </div>

            <div class="space-y-3">
                @forelse ($schedules as $schedule)
                    <div class="bg-white rounded-2xl shadow-sm border border-trail-100/60 p-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <h3 class="font-semibold text-trail-900">{{ $schedule->tourPackage->title }}</h3>
                            <p class="text-sm text-gray-500">
                                {{ $schedule->departure_date->format('D, M j Y') }}
                                &middot; Guide: {{ $schedule->tourGuide->name ?? 'Unassigned' }}
                                &middot; {{ $schedule->seats_booked }}/{{ $schedule->max_seats }} booked
                            </p>
                        </div>

                        <div class="flex items-center gap-3">
                            <span @class([
                                'px-3 py-1 rounded-full text-xs font-medium',
                                'bg-blue-100 text-blue-800' => $schedule->status === 'scheduled',
                                'bg-yellow-100 text-yellow-800' => $schedule->status === 'ongoing',
                                'bg-trail-100 text-trail-700' => $schedule->status === 'completed',
                                'bg-gray-100 text-gray-600' => $schedule->status === 'cancelled',
                            ])>
                                {{ ucfirst($schedule->status) }}
                            </span>

                            @auth
                                @if (Auth::user()->isStaff())
                                    <a href="{{ route('admin.trips.show', $schedule) }}"
                                       class="text-sm font-medium text-trail-600 hover:text-trail-700">
                                        Manage
                                    </a>
                                @endif
                            @endauth
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-2xl shadow-sm p-10 text-center text-gray-500">No trips found.</div>
                @endforelse
            </div>

            <div>
                {{ $schedules->links() }}
            </div>
        </div>
    </div>
</x-app-layout>