<x-layouts.admin title="Admin Dashboard">
    <h1 class="text-3xl font-extrabold">Admin Dashboard</h1>
    <div class="mt-6 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">@foreach($stats as $label => $value)<x-admin.stat-card :label="$label" :value="$value" />@endforeach</div>
</x-layouts.admin>
