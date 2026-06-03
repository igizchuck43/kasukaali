@props(['status'])
<span class="rounded-full px-3 py-1 text-xs font-bold {{ in_array($status, ['approved','active','read','resolved']) ? 'bg-success text-white' : (in_array($status, ['pending','unread']) ? 'bg-accent text-secondary' : 'bg-danger text-white') }}">{{ ucfirst($status) }}</span>
