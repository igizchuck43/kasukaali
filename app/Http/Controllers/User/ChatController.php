<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Models\Message;
use App\Models\UserMatch;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ChatController extends Controller
{
    public function show(UserMatch $match): View
    {
        $this->authorizeMatch($match);
        $messages = $match->messages()->with(['sender', 'receiver'])->oldest()->get();
        $match->messages()->where('receiver_id', auth()->id())->where('is_read', false)->update(['is_read' => true, 'read_at' => now()]);

        if (request()->ajax()) {
            return view('components.user.chat-box', compact('messages'));
        }

        $matches = UserMatch::where('status', 'active')
            ->where(fn ($query) => $query->where('user_one_id', auth()->id())->orWhere('user_two_id', auth()->id()))
            ->with(['userOne', 'userTwo', 'messages'])
            ->get();

        return view('user.chat', compact('match', 'matches', 'messages'));
    }

    public function store(MessageRequest $request, UserMatch $match): RedirectResponse
    {
        $this->authorizeMatch($match);
        $receiver = $match->otherUser($request->user());

        Message::create([
            'match_id' => $match->id,
            'sender_id' => $request->user()->id,
            'receiver_id' => $receiver->id,
            'message' => $request->validated('message'),
            'attachment_path' => $request->file('attachment')?->store('message-attachments', 'public'),
        ]);
        $match->update(['last_message_at' => now()]);

        return back();
    }

    private function authorizeMatch(UserMatch $match): void
    {
        abort_unless($match->status === 'active' && in_array(auth()->id(), [$match->user_one_id, $match->user_two_id], true), 403);
    }
}
