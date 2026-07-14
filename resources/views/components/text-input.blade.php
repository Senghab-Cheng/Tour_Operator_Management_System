@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full rounded-lg border-trail-100 bg-trail-50/60 text-trail-900 placeholder:text-trail-900/40 focus:border-trail-500 focus:ring-trail-500 focus:bg-white transition-colors']) }}>