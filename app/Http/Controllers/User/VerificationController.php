<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\VerificationRequest as VerificationFormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class VerificationController extends Controller
{
    public function index(): View
    {
        return view('user.verification', ['requests' => auth()->user()->verificationRequests()->latest()->get()]);
    }

    public function store(VerificationFormRequest $request): RedirectResponse
    {
        $request->user()->verificationRequests()->create([
            'selfie_path' => $request->file('selfie')->store('verification', 'public'),
            'document_path' => $request->file('document')->store('verification', 'public'),
        ]);

        return back()->with('status', 'Verification request submitted.');
    }
}
