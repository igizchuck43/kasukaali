<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUserUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::query()
            ->when(request('status'), fn ($query, $status) => $query->where('status', $status))
            ->when(request('search'), fn ($query, $search) => $query->where(fn ($q) => $q->where('name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%")))
            ->latest()
            ->paginate(15);

        return view('admin.users', compact('users'));
    }

    public function show(User $user): View
    {
        return view('admin.user-show', ['user' => $user->load(['profile', 'photos', 'interests'])]);
    }

    public function update(AdminUserUpdateRequest $request, User $user): RedirectResponse
    {
        abort_if($user->isAdmin() && $user->id !== $request->user()->id, 403);
        $user->update($request->validated() + [
            'is_verified' => $request->boolean('is_verified'),
            'is_premium' => $request->boolean('is_premium'),
        ]);

        return back()->with('status', 'User updated.');
    }

    public function destroy(User $user): RedirectResponse
    {
        abort_if($user->isAdmin(), 403);
        $user->delete();

        return redirect()->route('admin.users.index')->with('status', 'User deleted.');
    }
}
