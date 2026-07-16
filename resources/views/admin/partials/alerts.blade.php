@if (session('success'))
    <div class="rounded-xl bg-green-50 border border-green-300 px-4 py-3 text-sm font-medium text-green-800 flex items-center gap-2" role="alert">
        <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-green-200 text-green-800 text-xs font-bold">✓</span>
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="rounded-xl bg-red-50 border border-red-300 px-4 py-3 text-sm text-red-800" role="alert">
        <p class="font-semibold mb-2">Please fix the following:</p>
        <ul class="list-disc ps-5 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
