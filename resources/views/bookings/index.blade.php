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

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-800 rounded-lg text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg divide-y divide-gray-100">
                @forelse ($bookings as $booking)
                    <div class="p-6">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
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

                        {{-- Review section, only for completed trips --}}
                        @if ($booking->status === 'completed')
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                @if ($booking->review)
                                    <div class="bg-trail-50/60 rounded-lg p-4">
                                        <p class="text-trail-500 text-sm mb-1">
                                            {{ str_repeat('★', $booking->review->rating) }}{{ str_repeat('☆', 5 - $booking->review->rating) }}
                                        </p>
                                        <p class="text-sm text-gray-700">{{ $booking->review->comment }}</p>
                                        <p class="text-xs text-gray-400 mt-1">Thanks for your feedback!</p>
                                    </div>
                                @else
                                    <details class="group">
                                        <summary class="cursor-pointer text-sm font-medium text-trail-600 hover:text-trail-700 list-none flex items-center gap-1">
                                            <span>Leave a review</span>
                                            <svg class="w-4 h-4 transition-transform group-open:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </summary>

                                        <form method="POST" action="{{ route('reviews.store') }}" class="mt-3 space-y-3">
                                            @csrf
                                            <input type="hidden" name="booking_id" value="{{ $booking->id }}">

                                            <div>
                                                <p class="text-xs text-gray-500 mb-1">Rating</p>
                                                <div class="flex gap-3">
                                                    @for ($i = 5; $i >= 1; $i--)
                                                        <label class="cursor-pointer">
                                                            <input type="radio" name="rating" value="{{ $i }}" class="peer sr-only" required>
                                                            <span class="text-2xl text-gray-300 peer-checked:text-trail-500 hover:text-trail-400">★</span>
                                                        </label>
                                                    @endfor
                                                </div>
                                            </div>

                                            <div>
                                                <textarea name="comment" rows="2" maxlength="2000"
                                                          class="w-full rounded-lg border-trail-100 bg-trail-50/60 text-sm focus:border-trail-500 focus:ring-trail-500"
                                                          placeholder="How was your trip?"></textarea>
                                            </div>

                                            <button type="submit"
                                                    class="inline-flex items-center px-4 py-2 bg-trail-500 text-white text-sm font-semibold rounded-full hover:bg-trail-600">
                                                Submit Review
                                            </button>
                                        </form>
                                    </details>
                                @endif
                            </div>
                        @endif
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