<div class="mx-auto max-w-2xl rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Import contacts</h1>
        <p class="mt-1 text-sm text-gray-500">
            Upload XML file with contacts.
        </p>
    </div>

    <form wire:submit="save" class="space-y-5">
        <div>
            <label for="file" class="mb-1 block text-sm font-medium text-gray-700">
                XML file
            </label>

            <input
                id="file"
                type="file"
                wire:model="file"
                accept=".xml,text/xml,application/xml"
                class="block w-full rounded-2xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900"
            >

            @error('file')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror

            <div wire:loading wire:target="file" class="mt-2 text-sm text-gray-500">
                Uploading...
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button
                type="submit"
                class="inline-flex items-center rounded-2xl bg-gray-900 px-5 py-3 text-sm font-medium text-white hover:bg-gray-800"
            >
                Start import
            </button>
        </div>
    </form>
</div>
