@props(['value', 'label', 'target' => null])
<div class="rounded-lg border border-borderSoft bg-white p-5 text-center shadow-soft">
    <div class="text-3xl font-extrabold text-primary">@if($target)<span data-counter="{{ $target }}">0</span>@else{{ $value }}@endif</div>
    <div class="mt-1 text-sm font-semibold text-muted">{{ $label }}</div>
</div>
