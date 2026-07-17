<!-- Navigation Links -->
<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    
    <!-- Shared/Customer Links -->
    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }}
    </x-nav-link>

<<<<<<< HEAD
    <x-nav-link :href="route('about')" :active="request()->routeIs('about')">
        {{ __('About') }}
    </x-nav-link>
=======
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('tour-packages.index')" :active="request()->routeIs('tour-packages.*')">
                        {{ __('Browse Tours') }}
                    </x-nav-link>
                    <x-nav-link :href="route('bookings.index')" :active="request()->routeIs('bookings.*')">
                        {{ __('My Bookings') }}
                    </x-nav-link>
                    @if (Auth::user()->isStaff())
                        <x-nav-link :href="route('admin.tour-schedules.index')" :active="request()->routeIs('*.trips.*') || request()->routeIs('*.tour-schedules.*')">
                            {{ __('Trips') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>
>>>>>>> 76a0b5abc8541227d3fcb2c0892cf8e176eaa0b9

    <x-nav-link :href="route('services')" :active="request()->routeIs('services')">
        {{ __('Service') }}
    </x-nav-link>

    <x-nav-link :href="route('tours.index')" :active="request()->routeIs('tours.*')">
        {{ __('Tour') }}
    </x-nav-link>

    <!-- Staff-Only Controls (Hidden from ordinary Customers) -->
    @if(auth()->user()->isStaff())
        <x-nav-link :href="route('guides.manage')" :active="request()->routeIs('guides.*')">
            {{ __('Guide (Manage)') }}
        </x-nav-link>

        <x-nav-link :href="route('contact.messages')" :active="request()->routeIs('contact.*')">
            {{ __('Contact Messages') }}
        </x-nav-link>
    @else
        <!-- What ordinary customers see instead -->
        <x-nav-link :href="route('guides.view')" :active="request()->routeIs('guides.view')">
            {{ __('Meet the Guides') }}
        </x-nav-link>
        
        <x-nav-link :href="route('contact.us')" :active="request()->routeIs('contact.us')">
            {{ __('Contact Us') }}
        </x-nav-link>
    @endif

<<<<<<< HEAD
</div>
=======
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    @auth
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('tour-packages.index')" :active="request()->routeIs('tour-packages.*')">
                {{ __('Browse Tours') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('bookings.index')" :active="request()->routeIs('bookings.*')">
                {{ __('My Bookings') }}
            </x-responsive-nav-link>
            @if (Auth::user()->isStaff())
                <x-responsive-nav-link :href="route('admin.tour-schedules.index')" :active="request()->routeIs('*.trips.*') || request()->routeIs('*.tour-schedules.*')">
                    {{ __('Trips') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
    @endauth
</nav>
>>>>>>> 76a0b5abc8541227d3fcb2c0892cf8e176eaa0b9
