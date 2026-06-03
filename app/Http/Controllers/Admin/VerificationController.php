<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VerificationRequest;
use App\Services\ModerationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class VerificationController extends Controller
{
    public function index(): View
    {
        return view('admin.verifications', ['requests' => VerificationRequest::with('user')->latest()->paginate(15)]);
    }

    public function approve(VerificationRequest $verificationRequest, ModerationService $moderation): RedirectResponse
    {
        $moderation->approveVerification($verificationRequest, auth()->user());
        return back()->with('status', 'Verification approved.');
    }

    public function reject(VerificationRequest $verificationRequest, ModerationService $moderation): RedirectResponse
    {
        $moderation->rejectVerification($verificationRequest, auth()->user(), request('rejection_reason', 'Verification could not be approved.'));
        return back()->with('status', 'Verification rejected.');
    }
}
