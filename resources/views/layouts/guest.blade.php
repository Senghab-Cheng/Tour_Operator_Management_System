<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Tourist') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600|fraunces:500,600,600i&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-trail-900 antialiased">
        <div class="min-h-screen grid lg:grid-cols-2">

            {{-- Left: photo + itinerary signature (hidden on small screens) --}}
            <div class="relative hidden lg:flex flex-col justify-between p-12 overflow-hidden bg-dusk-900">
                <img src="{{ asset('img/TourismInCam.png') }}" alt=""
                     class="absolute inset-0 w-full h-full object-cover opacity-40">
                <div class="absolute inset-0 bg-gradient-to-t from-dusk-900 via-dusk-900/60 to-dusk-900/20"></div>

                <a href="/" class="relative z-10 inline-flex items-center gap-2 text-white">
                    <i class="fa fa-map-marker-alt text-trail-400 text-xl"></i>
                    <span class="font-display text-xl tracking-tight">Tourist</span>
                </a>

                <div class="relative z-10">
                    {{-- Signature: a dotted route line with two waypoints --}}
                    <div class="flex items-center gap-3 mb-6 text-trail-400">
                        <span class="w-2.5 h-2.5 rounded-full bg-trail-400"></span>
                        <span class="flex-1 border-t border-dashed border-trail-400/50"></span>
                        <i class="fa fa-plane text-sm -rotate-45"></i>
                        <span class="flex-1 border-t border-dashed border-trail-400/50"></span>
                        <i class="fa fa-map-marker-alt"></i>
                    </div>
                    <h1 class="font-display text-4xl text-white leading-tight mb-3">
                        Every trip starts<br>with a single sign in.
                    </h1>
                    <p class="text-trail-100/80 max-w-sm">
                        Book tours, track your itinerary, and hear straight from your guide before you ever leave home.
                    </p>
                </div>
            </div>

            {{-- Right: form panel --}}
            <div class="flex flex-col justify-center items-center px-6 py-12 bg-trail-50">
                <a href="/" class="lg:hidden mb-8 inline-flex items-center gap-2 text-trail-900">
                    <i class="fa fa-map-marker-alt text-trail-500 text-xl"></i>
                    <span class="font-display text-xl">Tourist</span>
                </a>

                <div class="w-full sm:max-w-sm bg-white border border-trail-100 shadow-sm rounded-2xl px-8 py-10">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>