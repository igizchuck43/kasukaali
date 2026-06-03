<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;
use Illuminate\View\View;

class SubscriptionController extends Controller
{
    public function index(): View
    {
        return view('user.subscription', ['plans' => SubscriptionPlan::where('status', 'active')->get()]);
    }

    public function boost(): View
    {
        return view('user.boost');
    }
}
