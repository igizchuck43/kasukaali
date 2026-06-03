<x-layouts.user title="Edit Profile">
    <h1 class="text-3xl font-extrabold">Edit Profile</h1>
    <form method="POST" action="{{ route('user.profile.update') }}" class="mt-6 grid gap-5 rounded-lg border border-borderSoft bg-white p-6 shadow-soft sm:grid-cols-2">@csrf @method('PUT')
        <label class="sm:col-span-2 text-sm font-semibold">Headline<input name="headline" value="{{ old('headline', $user->profile?->headline) }}" class="mt-2 w-full rounded-lg border border-borderSoft px-4 py-3"></label>
        <label class="sm:col-span-2 text-sm font-semibold">Bio<textarea name="bio" rows="5" class="mt-2 w-full rounded-lg border border-borderSoft px-4 py-3">{{ old('bio', $user->profile?->bio) }}</textarea></label>
        @foreach(['occupation','education','company','location','height','religion','smoking','drinking','children','zodiac','personality_type','love_language','max_distance','age_min','age_max'] as $field)
            <label class="text-sm font-semibold">{{ ucfirst(str_replace('_',' ', $field)) }}<input name="{{ $field }}" value="{{ old($field, $user->profile?->{$field}) }}" class="mt-2 w-full rounded-lg border border-borderSoft px-4 py-3"></label>
        @endforeach
        <label class="text-sm font-semibold">Show me<select name="show_me" class="mt-2 w-full rounded-lg border border-borderSoft px-4 py-3"><option value="everyone">Everyone</option><option value="woman">Women</option><option value="man">Men</option></select></label>
        <label class="text-sm font-semibold">Visibility<select name="profile_visibility" class="mt-2 w-full rounded-lg border border-borderSoft px-4 py-3"><option value="public">Public</option><option value="matches_only">Matches only</option><option value="hidden">Hidden</option></select></label>
        <div class="sm:col-span-2"><div class="font-semibold">Interests</div><div class="mt-3 flex flex-wrap gap-3">@foreach($interests as $interest)<label class="rounded-full border border-borderSoft px-3 py-2 text-sm"><input type="checkbox" name="interests[]" value="{{ $interest->id }}" @checked($user->interests->contains($interest))> {{ $interest->name }}</label>@endforeach</div></div>
        <button class="btn-primary sm:col-span-2">Save Profile</button>
    </form>
</x-layouts.user>
