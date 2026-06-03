<header class="sticky top-0 z-40 border-b border-borderSoft bg-white/95 backdrop-blur">
    <nav class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
        <a href="{{ route('home') }}" class="text-2xl font-extrabold text-primary">Kasukaali</a>
        <button data-mobile-menu="#public-menu" class="rounded-full border border-borderSoft px-4 py-2 text-sm font-semibold md:hidden">Menu</button>
        <div id="public-menu" class="hidden items-center gap-5 text-sm font-semibold text-secondary md:flex">
            <a href="{{ route('how') }}" class="hover:text-primary">How It Works</a>
            <a href="{{ route('features') }}" class="hover:text-primary">Features</a>
            <a href="{{ route('safety') }}" class="hover:text-primary">Safety</a>
            <a href="{{ route('premium') }}" class="hover:text-primary">Premium</a>
            <a href="{{ route('contact') }}" class="hover:text-primary">Contact</a>
            @auth
                <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('user.dashboard') }}" class="btn-secondary py-2">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn-secondary py-2">Login</a>
                <a href="{{ route('register') }}" class="btn-primary py-2">Join Kasukaali</a>
            @endauth
        </div>
    </nav>
</header>
