<div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">
    <h1 class="text-xl font-semibold mb-6">New contact</h1>

    @if (session()->has('success'))
        <div class="mb-4 rounded-lg bg-green-100 px-4 py-3 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit="save" class="space-y-4">
        <div>
            <label for="first_name" class="block text-sm font-medium mb-1">First name</label>
            <input
                id="first_name"
                type="text"
                wire:model="first_name"
                class="w-full rounded-lg border px-3 py-2"
            >
            @error('first_name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="last_name" class="block text-sm font-medium mb-1">Last name</label>
            <input
                id="last_name"
                type="text"
                wire:model="last_name"
                class="w-full rounded-lg border px-3 py-2"
            >
            @error('last_name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium mb-1">Email</label>
            <input
                id="email"
                type="email"
                wire:model="email"
                class="w-full rounded-lg border px-3 py-2"
            >
            @error('email')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="pt-2">
            <button
                type="submit"
                class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700"
            >
                Save
            </button>
        </div>
    </form>
</div>
