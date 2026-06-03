<section class="overflow-hidden bg-white">
    <div class="mx-auto grid max-w-7xl items-center gap-10 px-4 py-16 sm:px-6 lg:grid-cols-2 lg:px-8 lg:py-20">
        <div class="animate-fade-up">
            <h1 class="max-w-2xl text-4xl font-extrabold leading-tight tracking-normal text-secondary sm:text-6xl">Meet People Who Match Your Energy</h1>
            <p class="mt-5 max-w-xl text-lg leading-8 text-muted">Kasukaali helps you discover real people, meaningful conversations, and exciting connections near you.</p>
            <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                <a href="{{ route('register') }}" class="btn-primary">Join Kasukaali</a>
                <a href="{{ route('how') }}" class="btn-secondary">See How It Works</a>
            </div>
        </div>
        <div class="relative min-h-[520px]">
            <div class="absolute left-4 top-8 w-64 animate-float rounded-lg border border-borderSoft bg-white p-4 shadow-soft">
                <div class="h-72 rounded-lg bg-[url('https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=900&q=80')] bg-cover bg-center"></div>
                <div class="mt-4 flex items-center justify-between"><div><div class="font-bold">Amina, 27</div><div class="text-sm text-muted">Kampala</div></div><span class="rounded-full bg-success px-3 py-1 text-xs font-bold text-white">Verified</span></div>
            </div>
            <div class="absolute right-0 top-24 w-60 rounded-lg border border-borderSoft bg-white p-4 shadow-soft">
                <div class="h-64 rounded-lg bg-[url('https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=900&q=80')] bg-cover bg-center"></div>
                <div class="mt-4 font-bold">Daniel, 30</div>
            </div>
            <div class="absolute bottom-16 left-16 rounded-full bg-primary px-5 py-3 font-bold text-white shadow-glow">It is a Match</div>
            <div class="absolute bottom-5 right-12 rounded-full border border-borderSoft bg-white px-5 py-3 font-bold text-primary shadow-soft">♥ Super Like</div>
        </div>
    </div>
</section>
