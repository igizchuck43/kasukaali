<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\PhotoUploadRequest;
use App\Models\ProfilePhoto;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PhotoController extends Controller
{
    public function index(): View
    {
        return view('user.photos', ['photos' => auth()->user()->photos()->orderBy('sort_order')->get()]);
    }

    public function store(PhotoUploadRequest $request): RedirectResponse
    {
        abort_if($request->user()->photos()->count() >= 6, 422, 'You can upload up to six profile photos.');

        $request->user()->photos()->create([
            'image_path' => $request->file('photo')->store('profile-photos', 'public'),
            'is_primary' => ! $request->user()->photos()->exists(),
            'sort_order' => $request->user()->photos()->count() + 1,
            'status' => 'pending',
        ]);

        return back()->with('status', 'Photo uploaded for review.');
    }

    public function primary(ProfilePhoto $photo): RedirectResponse
    {
        abort_unless($photo->user_id === auth()->id(), 403);
        auth()->user()->photos()->update(['is_primary' => false]);
        $photo->update(['is_primary' => true]);

        return back()->with('status', 'Primary photo updated.');
    }

    public function destroy(ProfilePhoto $photo): RedirectResponse
    {
        abort_unless($photo->user_id === auth()->id(), 403);
        $photo->delete();

        return back()->with('status', 'Photo deleted.');
    }
}
