<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Bookings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg divide-y divide-gray-100">
                @forelse ($bookings as $booking)
                    <div class="p-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <p class="text-xs text-gray-400 mb-1">{{ $booking->booking_code }}</p>
                            <h3 class="font-semibold text-gray-900">
                                {{ $booking->tourSchedule->tourPackage->title }}
                            </h3>
                            <p class="text-sm text-gray-500">
                                {{ $booking->tourSchedule->departure_date->format('D, M j Y') }}
                                &middot; {{ $booking->number_of_people }} {{ Str::plural('person', $booking->number_of_people) }}
                                &middot; ${{ number_format($booking->total_price, 2) }}
                            </p>
                        </div>

                        <div class="flex items-center gap-3">
                            <span @class([
                                'px-3 py-1 rounded-full text-xs font-medium',
                                'bg-yellow-100 text-yellow-800' => $booking->status === 'pending',
                                'bg-green-100 text-green-800' => $booking->status === 'confirmed',
                                'bg-gray-100 text-gray-600' => $booking->status === 'cancelled',
                                'bg-blue-100 text-blue-800' => $booking->status === 'completed',
                            ])>
                                {{ ucfirst($booking->status) }}
                            </span>

                            @if (! in_array($booking->status, ['cancelled', 'completed']))
                                <form method="POST" action="{{ route('bookings.cancel', $booking) }}"
                                      onsubmit="return confirm('Cancel this booking?');">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-sm text-red-600 hover:text-red-800">
                                        Cancel
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="p-10 text-center">
                        <p class="text-gray-500 mb-4">You haven't booked a trip yet.</p>
                        <a href="{{ route('tour-packages.index') }}"
                           class="inline-flex items-center px-4 py-2 bg-trail-500 text-white text-sm font-semibold rounded-full hover:bg-trail-600">
                            Browse Tours
                        </a>
                    </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $bookings->links() }}
            </div>
        </div>
    </div>
</x-app-layout>