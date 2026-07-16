<nav class="admin-card p-3" aria-label="Admin sections">
    <div class="flex flex-wrap gap-2">
        <a href="{{ route('admin.tour-packages.index') }}"
           class="admin-tab {{ request()->routeIs('admin.tour-packages.*') ? 'admin-tab-active' : 'admin-tab-inactive' }}">
            Tours
        </a>
        <a href="{{ route('admin.tour-guides.index') }}"
           class="admin-tab {{ request()->routeIs('admin.tour-guides.*') ? 'admin-tab-active' : 'admin-tab-inactive' }}">
            Guides
        </a>
        <a href="{{ route('admin.destinations.index') }}"
           class="admin-tab {{ request()->routeIs('admin.destinations.*') ? 'admin-tab-active' : 'admin-tab-inactive' }}">
            Destinations
        </a>
        <a href="{{ route('admin.tour-schedules.index') }}"
           class="admin-tab {{ request()->routeIs('admin.tour-schedules.*') ? 'admin-tab-active' : 'admin-tab-inactive' }}">
            Schedules
        </a>
        <a href="{{ route('admin.vehicles.index') }}"
           class="admin-tab {{ request()->routeIs('admin.vehicles.*') ? 'admin-tab-active' : 'admin-tab-inactive' }}">
            Vehicles
        </a>
    </div>
</nav>
