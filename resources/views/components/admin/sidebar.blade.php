<aside class="bg-secondary p-4 text-lightText lg:min-h-screen lg:w-72">
    <a href="{{ route('admin.dashboard') }}" class="text-2xl font-extrabold text-primary">Kasukaali</a>
    <nav class="mt-8 grid gap-1 text-sm font-semibold">
        @foreach(['dashboard'=>'Dashboard','users.index'=>'Users','approvals'=>'Pending Approvals','photos'=>'Profile Photos','reports'=>'Reports','verifications'=>'Verification','plans'=>'Plans','contact-messages'=>'Contact Messages','settings'=>'Site Settings'] as $route => $label)
            <a class="rounded-lg px-4 py-3 hover:bg-surfaceDark hover:text-primary" href="{{ route('admin.'.$route) }}">{{ $label }}</a>
        @endforeach
    </nav>
</aside>
