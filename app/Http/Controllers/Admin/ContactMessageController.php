<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    public function index(): View
    {
        return view('admin.contact-messages', ['messages' => ContactMessage::latest()->paginate(15)]);
    }

    public function read(ContactMessage $contactMessage): RedirectResponse
    {
        $contactMessage->update(['status' => 'read', 'read_at' => now()]);
        return back()->with('status', 'Message marked read.');
    }
}
