<x-layouts.user title="Dashboard">
    <h1 class="text-3xl font-extrabold">Dashboard</h1>
    <div class="mt-6 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">@foreach($stats as $label => $value)<x-user.stat-card :label="$label" :value="$value" />@endforeach</div>
    <div class="mt-8 rounded-lg border border-borderSoft bg-white p-6 shadow-soft"><h2 class="text-xl font-bold">Unlock Kasukaali Gold</h2><p class="mt-2 text-muted">See who likes you, boost your profile, and get more meaningful matches.</p><a href="{{ route('user.subscription') }}" class="btn-premium mt-5">Upgrade Now</a></div>
</x-layouts.user>
