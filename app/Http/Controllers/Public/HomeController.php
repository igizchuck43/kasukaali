<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\SafetyTip;
use App\Models\SubscriptionPlan;
use App\Models\Testimonial;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('public.home', [
            'testimonials' => Testimonial::where('status', 'active')->orderBy('sort_order')->limit(3)->get(),
            'faqs' => Faq::where('status', 'active')->orderBy('sort_order')->limit(4)->get(),
            'plans' => SubscriptionPlan::where('status', 'active')->get(),
            'safetyTips' => SafetyTip::where('status', 'active')->orderBy('sort_order')->limit(6)->get(),
        ]);
    }
}
