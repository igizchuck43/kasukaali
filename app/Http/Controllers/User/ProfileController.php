<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Interest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show(): View
    {
        return view('user.profile', ['user' => auth()->user()->load(['profile', 'photos', 'interests'])]);
    }

    public function edit(): View
    {
        return view('user.profile-edit', [
            'user' => auth()->user()->load(['profile', 'interests']),
            'interests' => Interest::where('status', 'active')->orderBy('name')->get(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $interests = $validated['interests'] ?? [];
        unset($validated['interests']);

        $request->user()->profile()->updateOrCreate(['user_id' => $request->user()->id], $validated);
        $request->user()->interests()->sync($interests);

        return redirect()->route('user.profile')->with('status', 'Profile updated.');
    }
}
