<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class NoticeController extends Controller
{
    public function pending(): View
    {
        return view('auth.notice', [
            'title' => 'Profile Under Review',
            'message' => 'Your Kasukaali profile is under review. Our team will approve your account after verifying your details.',
        ]);
    }

    public function rejected(): View
    {
        return view('auth.notice', [
            'title' => 'Account Rejected',
            'message' => auth()->user()?->rejected_reason ?: 'Your account was rejected after review. Contact support if you believe this was a mistake.',
        ]);
    }

    public function suspended(): View
    {
        return view('auth.notice', [
            'title' => 'Account Suspended',
            'message' => 'Your account is suspended while our moderation team reviews recent activity.',
        ]);
    }
}
