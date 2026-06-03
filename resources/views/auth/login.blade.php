<x-layouts.public title="Login">
    <section class="bg-surface py-16">
        <form method="POST" action="{{ route('login.store') }}" class="mx-auto max-w-md rounded-lg border border-borderSoft bg-white p-6 shadow-soft">
            @csrf
            <h1 class="text-3xl font-extrabold">Welcome Back</h1>
            <label class="mt-6 block text-sm font-semibold">Email<input name="email" type="email" value="{{ old('email') }}" class="mt-2 w-full rounded-lg border border-borderSoft px-4 py-3"></label>
            <label class="mt-4 block text-sm font-semibold">Password<input name="password" type="password" class="mt-2 w-full rounded-lg border border-borderSoft px-4 py-3"></label>
            <label class="mt-4 flex gap-3 text-sm"><input name="remember" type="checkbox"> Remember me</label>
            @if($errors->any())<div class="mt-4 rounded-lg bg-danger p-4 text-sm text-white">{{ $errors->first() }}</div>@endif
            <button class="btn-primary mt-6 w-full">Login</button>
        </form>
    </section>
</x-layouts.public>
