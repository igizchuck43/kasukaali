<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PageController extends Controller
{
    public function index(): View
    {
        return view('admin.content-list', ['title' => 'Pages', 'items' => Page::latest()->paginate(15)]);
    }

    public function store(PageRequest $request): RedirectResponse
    {
        Page::updateOrCreate(['slug' => $request->validated('slug')], $request->validated());
        return back()->with('status', 'Page saved.');
    }
}
