<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\MatchingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DiscoverController extends Controller
{
    public function index(MatchingService $matching): View
    {
        $user = auth()->user();

        if ($user->profileCompletionPercentage() < 40) {
            return view('user.discovery-locked');
        }

        return view('user.discover', ['profiles' => $matching->getSuggestedProfiles($user)]);
    }

    public function like(User $user, MatchingService $matching): RedirectResponse
    {
        $result = $matching->likeUser(auth()->user(), $user, request('type', 'like'));
        $message = $result['match'] ? "It's a Match! You and {$user->name} liked each other. Start the conversation now." : 'Your like was sent.';

        return back()->with($result['match'] ? 'match' : 'status', $message);
    }

    public function pass(User $user, MatchingService $matching): RedirectResponse
    {
        $matching->passUser(auth()->user(), $user);

        return back()->with('status', 'Profile passed.');
    }
}
