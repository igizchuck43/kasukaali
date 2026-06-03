<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SafetyTipRequest;
use App\Models\SafetyTip;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SafetyTipController extends Controller
{
    public function index(): View
    {
        return view('admin.content-list', ['title' => 'Safety Tips', 'items' => SafetyTip::latest()->paginate(15)]);
    }

    public function store(SafetyTipRequest $request): RedirectResponse
    {
        SafetyTip::create($request->validated());
        return back()->with('status', 'Safety tip saved.');
    }
}
