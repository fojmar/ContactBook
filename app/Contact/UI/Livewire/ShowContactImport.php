<?php declare(strict_types=1);

namespace App\Contact\UI\Livewire;

use App\Contact\Models\ContactImport;
use Livewire\Component;

class ShowContactImport extends Component
{
    public ContactImport $contactImport;

    public function mount(ContactImport $contactImport): void
    {
        $this->contactImport = $contactImport;
    }

    public function render()
    {
        $this->contactImport->refresh();

        return view('components.contacts.show-contact-import');
    }
}
