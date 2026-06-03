<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Kasukaali App' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface font-sans text-secondary antialiased">
    <div class="min-h-screen lg:flex">
        <x-user.sidebar />
        <div class="min-w-0 flex-1">
            <x-user.topbar />
            <main class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                @if (session('status')) <div class="mb-5 rounded-lg border border-borderSoft bg-white p-4 text-sm text-success shadow-soft">{{ session('status') }}</div> @endif
                @if (session('match')) <div data-modal class="mb-5 rounded-2xl border border-primary bg-white p-5 text-primary shadow-glow">{{ session('match') }}</div> @endif
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
