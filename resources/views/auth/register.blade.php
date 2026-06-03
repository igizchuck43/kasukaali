<x-layouts.public title="Join Kasukaali">
    <section class="bg-surface py-12">
        <form method="POST" action="{{ route('register.store') }}" class="mx-auto grid max-w-4xl gap-5 rounded-lg border border-borderSoft bg-white p-6 shadow-soft sm:grid-cols-2">
            @csrf
            <h1 class="sm:col-span-2 text-3xl font-extrabold">Create Your Kasukaali Profile</h1>
            @foreach(['name'=>'Full name','username'=>'Username','email'=>'Email','phone'=>'Phone number','city'=>'City / Location','looking_for'=>'Looking for','relationship_intention'=>'Relationship intention'] as $name => $label)
                <label class="text-sm font-semibold">{{ $label }}<input name="{{ $name }}" value="{{ old($name) }}" class="mt-2 w-full rounded-lg border border-borderSoft px-4 py-3"></label>
            @endforeach
            <label class="text-sm font-semibold">Gender<select name="gender" class="mt-2 w-full rounded-lg border border-borderSoft px-4 py-3"><option value="woman">Woman</option><option value="man">Man</option><option value="non_binary">Non-binary</option></select></label>
            <label class="text-sm font-semibold">Date of birth<input type="date" name="dob" value="{{ old('dob') }}" class="mt-2 w-full rounded-lg border border-borderSoft px-4 py-3"></label>
            <label class="text-sm font-semibold">Password<input type="password" name="password" class="mt-2 w-full rounded-lg border border-borderSoft px-4 py-3"></label>
            <label class="text-sm font-semibold">Confirm password<input type="password" name="password_confirmation" class="mt-2 w-full rounded-lg border border-borderSoft px-4 py-3"></label>
            <label class="sm:col-span-2 flex gap-3 text-sm"><input type="checkbox" name="terms" value="1"> I accept the Terms of Service, Privacy Policy, and Community Guidelines.</label>
            @if($errors->any())<div class="sm:col-span-2 rounded-lg bg-danger p-4 text-sm text-white">{{ $errors->first() }}</div>@endif
            <button class="btn-primary sm:col-span-2">Join Kasukaali</button>
        </form>
    </section>
</x-layouts.public>
