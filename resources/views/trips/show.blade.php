<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $tourSchedule->tourPackage->title }} &mdash; {{ $tourSchedule->departure_date->format('M j, Y') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Trip summary --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6 grid sm:grid-cols-3 gap-4 text-sm">
                <div>
                    <p class="text-gray-400">Status</p>
                    <p class="font-medium text-gray-900">{{ ucfirst($tourSchedule->status) }}</p>
                </div>
                <div>
                    <p class="text-gray-400">Guide</p>
                    <p class="font-medium text-gray-900">{{ $tourSchedule->tourGuide->name ?? 'Unassigned' }}</p>
                </div>
                <div>
                    <p class="text-gray-400">Seats</p>
                    <p class="font-medium text-gray-900">{{ $tourSchedule->seats_booked }} / {{ $tourSchedule->max_seats }} booked</p>
                </div>
            </div>

            {{-- Roster --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold text-gray-900 mb-4">Traveler Roster</h3>
                <div class="divide-y divide-gray-100">
                    @forelse ($tourSchedule->bookings as $booking)
                        <div class="py-3 flex justify-between items-center text-sm">
                            <div>
                                <p class="font-medium text-gray-900">{{ $booking->user->name }}</p>
                                <p class="text-gray-500">{{ $booking->number_of_people }} {{ Str::plural('person', $booking->number_of_people) }} &middot; {{ $booking->booking_code }}</p>
                            </div>
                            <span class="px-2 py-1 rounded-full text-xs bg-gray-100 text-gray-600">{{ ucfirst($booking->status) }}</span>
                        </div>
                    @empty
                        <p class="text-gray-500 text-sm py-3">No bookings yet for this trip.</p>
                    @endforelse
                </div>
            </div>

            {{-- Guide comments --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold text-gray-900 mb-4">Comments from Tour Guide</h3>

                <div class="space-y-4 mb-6">
                    @forelse ($tourSchedule->comments as $comment)
                        <div class="border-l-2 border-trail-400 pl-4">
                            <p class="text-sm text-gray-800">{{ $comment->comment }}</p>
                            <p class="text-xs text-gray-400 mt-1">
                                &mdash; {{ $comment->tourGuide->name }}
                                <span class="text-gray-300">(logged by {{ $comment->postedBy->name }}, {{ $comment->created_at->diffForHumans() }})</span>
                            </p>
                        </div>
                    @empty
                        <p class="text-gray-500 text-sm">No comments logged for this trip yet.</p>
                    @endforelse
                </div>

                <form method="POST" action="{{ route('admin.trips.comments.store', $tourSchedule) }}" class="space-y-3">
                    @csrf
                    <div>
                        <x-input-label for="tour_guide_id" value="On behalf of" />
                        <select name="tour_guide_id" id="tour_guide_id" required
                                class="w-full rounded-lg border-trail-100 bg-trail-50/60 focus:border-trail-500 focus:ring-trail-500">
                            @foreach ($guides as $guide)
                                <option value="{{ $guide->id }}" @selected($tourSchedule->tour_guide_id === $guide->id)>
                                    {{ $guide->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <x-input-label for="comment" value="Comment" />
                        <textarea name="comment" id="comment" rows="3" required
                                  class="w-full rounded-lg border-trail-100 bg-trail-50/60 focus:border-trail-500 focus:ring-trail-500"
                                  placeholder="e.g. Everyone arrived on time, group is in great spirits."></textarea>
                    </div>
                    <x-primary-button class="w-auto px-6">Add Comment</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>