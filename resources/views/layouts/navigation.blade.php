<!-- Navigation Links -->
<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    
    <!-- Shared/Customer Links -->
    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }}
    </x-nav-link>

    <x-nav-link :href="route('about')" :active="request()->routeIs('about')">
        {{ __('About') }}
    </x-nav-link>

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

</div>