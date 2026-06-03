<header class="border-b border-borderSoft bg-white px-4 py-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between">
        <div><div class="text-sm text-muted">Welcome back</div><div class="font-bold">{{ auth()->user()->name }}</div></div>
        <form method="POST" action="{{ route('logout') }}">@csrf<button class="btn-secondary py-2">Logout</button></form>
    </div>
</header>
