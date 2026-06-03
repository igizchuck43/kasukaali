<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors(['email' => 'These credentials do not match our records.'])->onlyInput('email');
        }

        $request->session()->regenerate();
        $user = $request->user();
        $user->update(['last_active_at' => now()]);

        if ($user->isBanned()) {
            Auth::logout();
            abort(403, 'This account is banned.');
        }

        return match (true) {
            $user->isAdmin() => redirect()->route('admin.dashboard'),
            $user->isModerator() => redirect()->route('moderator.dashboard'),
            $user->isSuspended() => redirect()->route('notice.suspended'),
            $user->isRejected() => redirect()->route('notice.rejected'),
            $user->isPending() => redirect()->route('notice.pending'),
            default => redirect()->route('user.dashboard'),
        };
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
