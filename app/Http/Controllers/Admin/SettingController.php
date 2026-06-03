<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function index(): View
    {
        return view('admin.settings', ['settings' => SiteSetting::orderBy('group')->orderBy('key')->paginate(20)]);
    }

    public function store(SettingRequest $request): RedirectResponse
    {
        SiteSetting::updateOrCreate(['key' => $request->validated('key')], $request->validated());
        return back()->with('status', 'Setting saved.');
    }
}
