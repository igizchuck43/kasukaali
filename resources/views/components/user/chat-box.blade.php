@foreach($messages as $message)
    <div class="mb-3 flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
        <div class="max-w-[78%] rounded-2xl {{ $message->sender_id === auth()->id() ? 'bg-primary text-white' : 'bg-surface text-secondary' }} px-4 py-3 text-sm">
            {{ $message->message }}
            <div class="mt-1 text-[11px] opacity-70">{{ $message->created_at->diffForHumans() }}</div>
        </div>
    </div>
@endforeach
