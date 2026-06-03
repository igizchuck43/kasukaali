<aside class="border-r border-borderSoft bg-white p-4 lg:min-h-screen lg:w-72">
    <a href="{{ route('user.dashboard') }}" class="text-2xl font-extrabold text-primary">Kasukaali</a>
    <nav class="mt-8 grid gap-1 text-sm font-semibold">
        @foreach(['dashboard'=>'Dashboard','profile'=>'My Profile','photos'=>'Upload Photos','discover'=>'Discover','matches'=>'Matches','verification'=>'Verification','subscription'=>'Subscription','safety'=>'Safety Center','settings'=>'Settings'] as $route => $label)
            <a class="rounded-lg px-4 py-3 hover:bg-surface hover:text-primary" href="{{ route('user.'.$route) }}">{{ $label }}</a>
        @endforeach
    </nav>
</aside>
