<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function create(): View
    {
        return view('public.contact');
    }

    public function store(ContactRequest $request): RedirectResponse
    {
        ContactMessage::create($request->validated());
        return back()->with('status', 'Thanks for reaching out. The Kasukaali team will reply soon.');
    }
}
