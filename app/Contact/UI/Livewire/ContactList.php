<?php declare(strict_types=1);

namespace App\Contact\UI\Livewire;

use App\Contact\Actions\DeleteContact;
use App\Contact\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;

class ContactList extends Component
{
    use WithPagination;

    public string $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $contacts = trim($this->search) === ''
            ? Contact::query()
                ->orderBy('last_name')
                ->orderBy('first_name')
                ->paginate(10)
            : Contact::search($this->search)->paginate(10);

        return view('components.contacts.contact-list', [
            'contacts' => $contacts,
        ]);
    }

    public function delete(DeleteContact $deleteContact, int $id): void
    {
        $deleteContact->handle($id);

        session()->flash('success', 'Contact deleted.');
    }
}
