@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-trail-900 mb-1.5']) }}>
    {{ $value ?? $slot }}
</label>