<button {{ $attributes->merge(['type' => 'button', 'class' => 'w-full inline-flex justify-center items-center px-4 py-2.5 bg-white border border-trail-100 rounded-full font-semibold text-sm text-trail-900 hover:bg-trail-50 focus:outline-none focus:ring-2 focus:ring-trail-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>