<x-guest-layout>
    <h2 class="font-display text-2xl text-trail-900 mb-1">Welcome back</h2>
    <p class="text-sm text-trail-900/60 mb-6">Sign in to manage your bookings.</p>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-trail-100 text-trail-500 shadow-sm focus:ring-trail-500" name="remember">
                <span class="ms-2 text-sm text-trail-900/70">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-trail-600 hover:text-trail-700" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <x-primary-button>{{ __('Sign In') }}</x-primary-button>

        <p class="text-center text-sm text-trail-900/60">
            {{ __("Don't have an account?") }}
            <a href="{{ route('register') }}" class="font-medium text-trail-600 hover:text-trail-700">{{ __('Sign up') }}</a>
        </p>
    </form>
</x-guest-layout>