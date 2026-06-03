<x-layouts.user title="My Profile">
    <div class="flex items-center justify-between"><h1 class="text-3xl font-extrabold">My Profile</h1><a class="btn-primary" href="{{ route('user.profile.edit') }}">Edit Profile</a></div>
    <div class="mt-6 grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-1"><x-user.profile-card :user="$user" /></div>
        <div class="rounded-lg border border-borderSoft bg-white p-6 shadow-soft lg:col-span-2"><h2 class="text-xl font-bold">Completion</h2><div class="mt-3 h-3 rounded-full bg-surface"><div class="h-3 rounded-full bg-primary" style="width: {{ $user->profileCompletionPercentage() }}%"></div></div><p class="mt-3 text-sm text-muted">{{ $user->profileCompletionPercentage() }}% complete</p><p class="mt-5 text-muted">{{ $user->profile?->bio }}</p></div>
    </div>
</x-layouts.user>
