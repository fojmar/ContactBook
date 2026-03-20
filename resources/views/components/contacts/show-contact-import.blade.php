<div wire:poll.2s class="mx-auto max-w-3xl space-y-6">
    <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
        <h1 class="text-2xl font-semibold text-gray-900">Import status</h1>
        <p class="mt-1 text-sm text-gray-500">{{ $contactImport->original_filename }}</p>
    </div>

    <div class="grid gap-4 md:grid-cols-2">
        <div class="rounded-2xl border border-gray-200 bg-white p-4">
            <div class="text-sm text-gray-500">Status</div>
            <div class="mt-1 text-lg font-semibold text-gray-900">
                {{ $contactImport->status }}
            </div>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-4">
            <div class="text-sm text-gray-500">Duration</div>
            <div class="mt-1 text-lg font-semibold text-gray-900">
                {{ $contactImport->duration_ms ? $contactImport->duration_ms . ' ms' : '—' }}
            </div>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-4">
            <div class="text-sm text-gray-500">Total</div>
            <div class="mt-1 text-lg font-semibold text-gray-900">
                {{ $contactImport->total_records }}
            </div>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-4">
            <div class="text-sm text-gray-500">Processed</div>
            <div class="mt-1 text-lg font-semibold text-gray-900">
                {{ $contactImport->processed_records }}
            </div>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-4">
            <div class="text-sm text-gray-500">Imported</div>
            <div class="mt-1 text-lg font-semibold text-gray-900">
                {{ $contactImport->imported_records }}
            </div>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-4">
            <div class="text-sm text-gray-500">Invalid</div>
            <div class="mt-1 text-lg font-semibold text-gray-900">
                {{ $contactImport->invalid_records }}
            </div>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-4">
            <div class="text-sm text-gray-500">Duplicates</div>
            <div class="mt-1 text-lg font-semibold text-gray-900">
                {{ $contactImport->duplicate_records }}
            </div>
        </div>
    </div>

    @if ($contactImport->error_message)
        <div class="rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            {{ $contactImport->error_message }}
        </div>
    @endif
</div>
