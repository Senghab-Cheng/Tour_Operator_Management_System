<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Trips') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg divide-y divide-gray-100">
                @forelse ($schedules as $schedule)
                    <div class="p-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <h3 class="font-semibold text-gray-900">{{ $schedule->tourPackage->title }}</h3>
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
                                'bg-green-100 text-green-800' => $schedule->status === 'completed',
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
                    <div class="p-10 text-center text-gray-500">No trips found.</div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $schedules->links() }}
            </div>
        </div>
    </div>
</x-app-layout>