<x-layouts.public title="Kasukaali - Meet People Who Match Your Energy">
    <x-public.hero />
    <section class="bg-surface py-12">
        <div class="mx-auto grid max-w-7xl gap-4 px-4 sm:grid-cols-2 sm:px-6 lg:grid-cols-4 lg:px-8">
            <x-public.counter-card value="10K+" label="Members" target="10000" />
            <x-public.counter-card value="5K+" label="Matches" target="5000" />
            <x-public.counter-card value="99%" label="Safer Profiles" target="99" />
            <x-public.counter-card value="24/7" label="Moderation" />
        </div>
    </section>
    <section class="py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold">How It Works</h2>
            <div class="mt-8 grid gap-5 md:grid-cols-4">
                @foreach(['Create Your Profile','Discover People','Match With Interest','Start Chatting'] as $item)
                    <x-public.feature-card :title="$item" body="A simple, safe step toward better connections." />
                @endforeach
            </div>
        </div>
    </section>
    <section class="bg-surface py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold">Feature Highlights</h2>
            <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-5">
                @foreach(['Smart Matching','Verified Profiles','Private Messaging','Interest-Based Discovery','Location-Based Matches','Super Likes','Profile Boost','Report & Block Safety','Admin Approval System','Premium Visibility'] as $feature)
                    <x-public.feature-card :title="$feature" body="Designed for clean discovery, trust, and confident conversations." />
                @endforeach
            </div>
        </div>
    </section>
    <section class="py-16">
        <div class="mx-auto grid max-w-7xl gap-8 px-4 sm:px-6 lg:grid-cols-2 lg:px-8">
            <div><h2 class="text-3xl font-extrabold">Safety First</h2><p class="mt-4 text-muted">Manual account approval, photo verification, report and block controls, privacy settings, community guidelines, and a moderation dashboard keep the experience intentional.</p></div>
            <div class="grid gap-4 sm:grid-cols-2">@foreach($safetyTips as $tip)<x-public.feature-card :title="$tip->title" :body="$tip->content" />@endforeach</div>
        </div>
    </section>
    <section class="bg-surface py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold">Premium Plans</h2>
            <div class="mt-8 grid gap-5 md:grid-cols-4">@foreach($plans as $plan)<x-public.pricing-card :plan="$plan" />@endforeach</div>
        </div>
    </section>
    <section class="py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold">Success Stories</h2>
            <div class="mt-8 grid gap-5 md:grid-cols-3">@foreach($testimonials as $testimonial)<x-public.testimonial-card :testimonial="$testimonial" />@endforeach</div>
        </div>
    </section>
    <section class="bg-surface py-16">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold">FAQ</h2>
            <div class="mt-8 space-y-4">@foreach($faqs as $faq)<div class="rounded-lg border border-borderSoft bg-white p-5 shadow-soft"><h3 class="font-bold">{{ $faq->question }}</h3><p class="mt-2 text-sm text-muted">{{ $faq->answer }}</p></div>@endforeach</div>
        </div>
    </section>
    <section class="py-16 text-center">
        <h2 class="text-3xl font-extrabold">Your Next Connection Could Start Today</h2>
        <a href="{{ route('register') }}" class="btn-primary mt-6">Join Kasukaali</a>
    </section>
</x-layouts.public>
