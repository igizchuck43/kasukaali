<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApprovalRequest;
use App\Models\User;
use App\Services\ModerationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ApprovalController extends Controller
{
    public function index(): View
    {
        return view('admin.approvals', ['users' => User::where('status', 'pending')->latest()->paginate(15)]);
    }

    public function approve(User $user, ModerationService $moderation): RedirectResponse
    {
        $moderation->approveUser($user, auth()->user());
        return back()->with('status', 'User approved.');
    }

    public function reject(ApprovalRequest $request, User $user, ModerationService $moderation): RedirectResponse
    {
        $moderation->rejectUser($user, $request->user(), $request->validated('reason'));
        return back()->with('status', 'User rejected.');
    }

    public function suspend(User $user): RedirectResponse
    {
        $user->update(['status' => 'suspended']);
        return back()->with('status', 'User suspended.');
    }

    public function ban(User $user): RedirectResponse
    {
        abort_if($user->isAdmin(), 403);
        $user->update(['status' => 'banned']);
        return back()->with('status', 'User banned.');
    }

    public function restore(User $user): RedirectResponse
    {
        $user->update(['status' => 'approved', 'approved_at' => now(), 'approved_by' => auth()->id()]);
        return back()->with('status', 'User restored.');
    }

    public function verify(User $user): RedirectResponse
    {
        $user->update(['is_verified' => true]);
        return back()->with('status', 'User marked verified.');
    }

    public function unverify(User $user): RedirectResponse
    {
        $user->update(['is_verified' => false]);
        return back()->with('status', 'Verification removed.');
    }
}
