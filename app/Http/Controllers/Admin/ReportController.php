<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Services\ModerationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(): View
    {
        return view('admin.reports', ['reports' => Report::with(['reporter', 'reportedUser'])->latest()->paginate(15)]);
    }

    public function update(Report $report, ModerationService $moderation): RedirectResponse
    {
        $moderation->reviewReport($report, auth()->user(), request('status', 'reviewed'), request('admin_notes'));
        return back()->with('status', 'Report reviewed.');
    }
}
