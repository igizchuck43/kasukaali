@props(['title', 'body' => '', 'icon' => '♥'])
<article class="rounded-lg border border-borderSoft bg-white p-6 shadow-soft transition hover:-translate-y-1">
    <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-full bg-surface text-xl text-primary">{{ $icon }}</div>
    <h3 class="text-lg font-bold">{{ $title }}</h3>
    <p class="mt-2 text-sm leading-6 text-muted">{{ $body }}</p>
</article>
