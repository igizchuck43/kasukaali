<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FaqRequest;
use App\Models\Faq;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function index(): View
    {
        return view('admin.content-list', ['title' => 'FAQs', 'items' => Faq::latest()->paginate(15)]);
    }

    public function store(FaqRequest $request): RedirectResponse
    {
        Faq::create($request->validated());
        return back()->with('status', 'FAQ saved.');
    }
}
