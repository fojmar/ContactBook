<div class="space-y-6">
    <div class="flex items-center justify-between gap-4">
        <h1 class="text-2xl font-semibold">Contacts</h1>

        <a
            href="{{ route('contacts.create') }}"
            class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700"
>
            Create new
</a>
    </div>

    <div class="rounded-xl bg-white p-4 shadow">
        <input
            type="text"
            wire:model.live.debounce.300ms="search"
            placeholder="Search"
            class="w-full rounded-lg border px-3 py-2"
>
    </div>

    <div class="overflow-hidden rounded-xl bg-white shadow">
        <table class="min-w-full divide-y">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">First name</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Last name</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Email</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y bg-white">
@forelse ($contacts as $contact)
    <tr>
        <td class="px-4 py-3">{{ $contact->first_name }}</td>
        <td class="px-4 py-3">{{ $contact->last_name }}</td>
        <td class="px-4 py-3">{{ $contact->email }}</td>
        <td class="px-4 py-3">
            <div class="flex items-center gap-2">

                <a
                    href="{{ route('contacts.edit', $contact) }}"
                    class="inline-flex items-center rounded-md bg-gray-100 px-3 py-1.5 text-sm font-medium text-gray-700 hover:bg-gray-200 transition"
                >
                    ✏️ Edit
                </a>
                <button
                    wire:click="delete({{ $contact->id }})"
                    onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                    class="inline-flex items-center rounded-md bg-red-50 px-3 py-1.5 text-sm font-medium text-red-600 hover:bg-red-100 transition"
                >
                    🗑️ Delete
                </button>

            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="4" class="px-4 py-6 text-center text-gray-500">
            Contact not found.
        </td>
    </tr>
    @endforelse
    </tbody>
    </table>
    </div>

    <div>
        {{ $contacts->links() }}
    </div>
    </div>
