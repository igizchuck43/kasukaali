<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportRequest;
use App\Models\Block;
use App\Models\Report;
use App\Models\SafetyTip;
use App\Models\User;
use App\Models\UserMatch;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SafetyController extends Controller
{
    public function index(): View
    {
        return view('user.safety', ['tips' => SafetyTip::where('status', 'active')->orderBy('sort_order')->get()]);
    }

    public function reports(): View
    {
        return view('user.reports', ['reports' => auth()->user()->reports()->with('reportedUser')->latest()->get()]);
    }

    public function report(ReportRequest $request): RedirectResponse
    {
        Report::create($request->validated() + ['reporter_id' => $request->user()->id]);

        return back()->with('status', 'Report submitted for moderation.');
    }

    public function blocked(): View
    {
        return view('user.blocked', ['blocks' => auth()->user()->blocks()->with('blocked')->latest()->get()]);
    }

    public function block(User $user): RedirectResponse
    {
        Block::firstOrCreate(['blocker_id' => auth()->id(), 'blocked_id' => $user->id], ['reason' => request('reason')]);
        UserMatch::where(function ($query) use ($user) {
            $query->where('user_one_id', auth()->id())->where('user_two_id', $user->id);
        })->orWhere(function ($query) use ($user) {
            $query->where('user_one_id', $user->id)->where('user_two_id', auth()->id());
        })->update(['status' => 'blocked']);

        return back()->with('status', 'User blocked.');
    }
}
