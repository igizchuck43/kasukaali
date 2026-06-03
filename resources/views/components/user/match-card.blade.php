@props(['match'])
@php($other = $match->otherUser(auth()->user()))
<a href="{{ route('user.chat', $match) }}" class="block rounded-lg border border-borderSoft bg-white p-4 shadow-soft hover:border-primary">
    <div class="font-bold">{{ $other->name }}</div>
    <div class="text-sm text-muted">{{ $match->messages->last()?->message ?? 'Start the conversation' }}</div>
</a>
