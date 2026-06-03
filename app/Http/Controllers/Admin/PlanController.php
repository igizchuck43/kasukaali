<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanRequest;
use App\Models\SubscriptionPlan;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PlanController extends Controller
{
    public function index(): View
    {
        return view('admin.plans', ['plans' => SubscriptionPlan::latest()->paginate(15)]);
    }

    public function store(PlanRequest $request): RedirectResponse
    {
        SubscriptionPlan::updateOrCreate(['slug' => $request->validated('slug')], $request->validated());
        return back()->with('status', 'Plan saved.');
    }
}
