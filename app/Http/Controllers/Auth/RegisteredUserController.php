<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'username' => ['required', 'alpha_dash', 'max:40', 'unique:users,username'],
            'email' => ['required', 'email', 'max:160', 'unique:users,email'],
            'phone' => ['required', 'string', 'max:40'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'gender' => ['required', 'in:woman,man,non_binary'],
            'dob' => ['required', 'date', 'before_or_equal:'.now()->subYears(18)->toDateString()],
            'city' => ['required', 'string', 'max:120'],
            'looking_for' => ['required', 'string', 'max:80'],
            'relationship_intention' => ['required', 'string', 'max:120'],
            'terms' => ['accepted'],
        ]);

        $user = User::create($validated + ['role' => 'user', 'status' => 'pending']);
        Profile::create(['user_id' => $user->id, 'location' => $user->city]);
        Auth::login($user);

        return redirect()->route('notice.pending');
    }
}
