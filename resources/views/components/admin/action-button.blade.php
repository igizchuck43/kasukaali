@props(['type' => 'submit'])
<button type="{{ $type }}" {{ $attributes->merge(['class' => 'rounded-full bg-primary px-4 py-2 text-xs font-bold text-white transition hover:bg-primaryDark']) }}>{{ $slot }}</button>
