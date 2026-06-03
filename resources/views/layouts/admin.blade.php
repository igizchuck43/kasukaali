<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Kasukaali Admin' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface font-sans text-secondary antialiased">
    <div class="min-h-screen lg:flex">
        <x-admin.sidebar />
        <div class="min-w-0 flex-1">
            <x-admin.topbar />
            <main class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                @if (session('status')) <div class="mb-5 rounded-lg border border-borderSoft bg-white p-4 text-sm text-success shadow-soft">{{ session('status') }}</div> @endif
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
