<x-layouts.public :title="$title">
    <section class="bg-surface py-20">
        <div class="mx-auto max-w-2xl rounded-lg border border-borderSoft bg-white p-8 text-center shadow-soft">
            <h1 class="text-3xl font-extrabold">{{ $title }}</h1>
            <p class="mt-4 leading-7 text-muted">{{ $message }}</p>
            <form method="POST" action="{{ route('logout') }}" class="mt-6">@csrf<button class="btn-secondary">Logout</button></form>
        </div>
    </section>
</x-layouts.public>
