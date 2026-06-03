<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserMatch;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MatchController extends Controller
{
    public function index(): View
    {
        $matches = UserMatch::with(['userOne.photos', 'userTwo.photos', 'messages'])
            ->where('status', 'active')
            ->where(fn ($query) => $query->where('user_one_id', auth()->id())->orWhere('user_two_id', auth()->id()))
            ->latest('last_message_at')
            ->paginate(12);

        return view('user.matches', compact('matches'));
    }

    public function unmatch(UserMatch $match): RedirectResponse
    {
        abort_unless(in_array(auth()->id(), [$match->user_one_id, $match->user_two_id], true), 403);
        $match->update(['status' => 'unmatched']);

        return back()->with('status', 'Match removed.');
    }
}
