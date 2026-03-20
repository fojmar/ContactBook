<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>ContactBook</title>

@vite(['resources/css/app.css', 'resources/js/app.js'])
@livewireStyles
</head>
<body class="bg-gray-100 text-gray-900">

<div class="min-h-screen">
    <nav class="bg-white shadow p-4">
        <div class="max-w-5xl mx-auto flex items-center justify-between">

            <h1 class="text-xl font-bold">
                <a href="{{ route('contacts.index') }}">ContactBook</a>
            </h1>

            <a
                href="{{ route('contacts.import') }}"
                wire:navigate
                class="inline-flex items-center rounded-2xl border border-gray-200 bg-gray-50 px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-100"
            >
                Import XML
            </a>

        </div>
    </nav>
    <main class="max-w-5xl mx-auto p-6">
        {{ $slot ?? '' }}
        @yield('content')
    </main>
</div>

@livewireScripts
</body>
</html>
