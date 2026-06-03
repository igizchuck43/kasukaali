<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Page;
use App\Models\SafetyTip;
use App\Models\SubscriptionPlan;
use App\Models\Testimonial;
use Illuminate\View\View;

class PageController extends Controller
{
    public function about(): View { return view('public.pages.simple', ['title' => 'About Kasukaali', 'body' => 'Kasukaali is built for real introductions, safe discovery, and meaningful conversations near you.']); }
    public function howItWorks(): View { return view('public.pages.simple', ['title' => 'How It Works', 'body' => 'Create a profile, discover people, like with intention, match mutually, then start chatting in a safe space.']); }
    public function features(): View { return view('public.pages.simple', ['title' => 'Features', 'body' => 'Smart matching, verified profiles, private messaging, super likes, boosts, premium visibility, and moderation tools.']); }
    public function safety(): View { return view('public.pages.safety', ['tips' => SafetyTip::where('status', 'active')->orderBy('sort_order')->get()]); }
    public function premium(): View { return view('public.pages.premium', ['plans' => SubscriptionPlan::where('status', 'active')->get()]); }
    public function stories(): View { return view('public.pages.stories', ['testimonials' => Testimonial::where('status', 'active')->orderBy('sort_order')->get()]); }
    public function faq(): View { return view('public.pages.faq', ['faqs' => Faq::where('status', 'active')->orderBy('sort_order')->get()]); }
    public function join(): View { return view('public.pages.simple', ['title' => 'Join Kasukaali', 'body' => 'Create your profile today. Mobile apps are planned, and the web app is ready for discovery now.']); }

    public function show(string $slug): View
    {
        $page = Page::where('slug', $slug)->where('status', 'published')->firstOrFail();
        return view('public.pages.page', compact('page'));
    }
}
