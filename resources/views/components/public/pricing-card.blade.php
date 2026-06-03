@props(['plan'])
<article class="rounded-lg border border-borderSoft bg-white p-6 shadow-soft">
    <div class="flex items-center justify-between">
        <h3 class="text-xl font-extrabold">{{ $plan->name }}</h3>
        @if($plan->slug !== 'free') <span class="rounded-full bg-accent px-3 py-1 text-xs font-bold text-secondary shadow-glow">Premium</span> @endif
    </div>
    <div class="mt-4 text-3xl font-extrabold">UGX {{ number_format($plan->price) }}</div>
    <p class="mt-2 text-sm text-muted">{{ $plan->description }}</p>
    <ul class="mt-5 space-y-2 text-sm text-secondary">
        @foreach(($plan->features ?? []) as $feature)<li>✓ {{ $feature }}</li>@endforeach
    </ul>
    <a href="{{ route('register') }}" class="{{ $plan->slug === 'free' ? 'btn-secondary' : 'btn-premium' }} mt-6 w-full">Choose {{ $plan->name }}</a>
</article>
