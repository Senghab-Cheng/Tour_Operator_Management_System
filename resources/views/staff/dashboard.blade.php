<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Staff Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-900">Welcome back, {{ auth()->user()->name }}</h3>
                    <p class="text-sm text-gray-600">Here is today's staff overview.</p>
                </div>

                <!-- STAFF OVERVIEW WIDGETS -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="p-4 bg-blue-50 rounded-xl border border-blue-100">
                        <span class="text-sm text-blue-600 font-medium">Total Bookings Today</span>
                        <p class="text-2xl font-bold text-slate-800">{{ $totalBookingsToday }}</p>
                    </div>
                    <div class="p-4 bg-green-50 rounded-xl border border-green-100">
                        <span class="text-sm text-green-600 font-medium">Active Guides</span>
                        <p class="text-2xl font-bold text-slate-800">{{ $activeGuides }}</p>
                    </div>
                    <div class="p-4 bg-amber-50 rounded-xl border border-amber-100">
                        <span class="text-sm text-amber-600 font-medium">Pending Inquiries</span>
                        <p class="text-2xl font-bold text-slate-800">{{ $pendingInquiries }}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>