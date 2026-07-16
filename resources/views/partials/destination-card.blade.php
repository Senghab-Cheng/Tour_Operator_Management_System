<a class="position-relative d-block overflow-hidden {{ $class ?? '' }}" href="{{ route('tour-packages.index', ['destination' => $destination->name]) }}">
    <img class="img-fluid {{ ! empty($tall) ? 'position-absolute w-100 h-100' : '' }}"
         src="{{ $destination->image_path ? asset($destination->image_path) : asset('img/destination-1.jpg') }}"
         alt="{{ $destination->name }}"
         @if (! empty($tall)) style="object-fit: cover;" @endif>
    @if ($destination->discount)
        <div class="bg-white text-danger fw-bold position-absolute top-0 start-0 m-3 py-1 px-2">{{ $destination->discount }}</div>
    @endif
    <div class="bg-white text-primary fw-bold position-absolute bottom-0 end-0 m-3 py-1 px-2">{{ $destination->name }}</div>
</a>
