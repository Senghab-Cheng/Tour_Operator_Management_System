<div class="card p-3 mb-4">
    <div class="d-flex flex-wrap gap-2">
        @php
            $links = [
                ['route' => 'admin.tour-packages.index', 'label' => 'Tours'],
                ['route' => 'admin.tour-guides.index', 'label' => 'Guides'],
                ['route' => 'admin.destinations.index', 'label' => 'Destinations'],
                ['route' => 'admin.tour-schedules.index', 'label' => 'Schedules'],
                ['route' => 'admin.vehicles.index', 'label' => 'Vehicles'],
                ['route' => 'admin.bookings.index', 'label' => 'Bookings'],
            ];
        @endphp
        @foreach ($links as $link)
            <a href="{{ route($link['route']) }}"
               class="btn {{ request()->routeIs(str_replace('.index', '.*', $link['route'])) ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill px-4">
                {{ $link['label'] }}
            </a>
        @endforeach
    </div>
</div>
