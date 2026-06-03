<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilePhoto;
use App\Services\ModerationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfilePhotoController extends Controller
{
    public function index(): View
    {
        return view('admin.photos', ['photos' => ProfilePhoto::with('user')->latest()->paginate(18)]);
    }

    public function approve(ProfilePhoto $photo, ModerationService $moderation): RedirectResponse
    {
        $moderation->setPhotoStatus($photo, 'approved');
        return back()->with('status', 'Photo approved.');
    }

    public function reject(ProfilePhoto $photo, ModerationService $moderation): RedirectResponse
    {
        $moderation->setPhotoStatus($photo, 'rejected');
        return back()->with('status', 'Photo rejected.');
    }
}
