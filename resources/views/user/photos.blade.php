<x-layouts.user title="Upload Photos">
    <h1 class="text-3xl font-extrabold">Upload Photos</h1>
    <form method="POST" action="{{ route('user.photos.store') }}" enctype="multipart/form-data" class="mt-6 rounded-lg border border-borderSoft bg-white p-6 shadow-soft">@csrf<input type="file" name="photo" class="w-full rounded-lg border border-borderSoft p-3"><button class="btn-primary mt-4">Upload Photo</button></form>
    <div class="mt-6 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">@foreach($photos as $photo)<div class="rounded-lg border border-borderSoft bg-white p-3 shadow-soft"><img src="{{ $photo->url() }}" class="h-64 w-full rounded-lg object-cover"><div class="mt-3 flex items-center justify-between"><x-admin.status-badge :status="$photo->status" /><form method="POST" action="{{ route('user.photos.primary', $photo) }}">@csrf @method('PATCH')<button class="text-sm font-bold text-primary">Set Primary</button></form></div></div>@endforeach</div>
</x-layouts.user>
