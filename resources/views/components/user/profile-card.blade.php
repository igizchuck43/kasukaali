@props(['user'])
<article data-profile-card class="overflow-hidden rounded-lg border border-borderSoft bg-white shadow-soft transition">
    <img class="h-96 w-full object-cover" src="{{ $user->primaryPhoto()?->url() ?? 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=900&q=80' }}" alt="{{ $user->name }}">
    <div class="p-5">
        <div class="flex items-center justify-between"><h3 class="text-2xl font-extrabold">{{ $user->name }}, {{ $user->age() }}</h3>@if($user->isVerified())<span class="rounded-full bg-success px-3 py-1 text-xs font-bold text-white">Verified</span>@endif</div>
        <p class="mt-2 text-sm text-muted">{{ $user->city }} · {{ $user->relationship_intention }}</p>
        <p class="mt-4 line-clamp-3 text-sm leading-6">{{ $user->profile?->bio }}</p>
        <div class="mt-4 flex flex-wrap gap-2">@foreach($user->interests->take(5) as $interest)<span class="rounded-full bg-surface px-3 py-1 text-xs font-semibold">{{ $interest->name }}</span>@endforeach</div>
        {{ $slot }}
    </div>
</article>
