@props(['testimonial'])
<article class="rounded-lg border border-borderSoft bg-white p-6 shadow-soft">
    <p class="text-sm leading-6 text-muted">"{{ $testimonial->story }}"</p>
    <div class="mt-5 font-bold">{{ $testimonial->name }}</div>
    <div class="text-sm text-primary">{{ $testimonial->location }}</div>
</article>
