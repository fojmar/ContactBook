<?php declare(strict_types=1);

namespace App\Contact\UI\Livewire;

use App\Contact\Actions\CreateContact;
use App\Contact\DTO\ContactData;
use App\Contact\Validation\ContactRules;
use Illuminate\View\View;
use Livewire\Component;

class CreateContactForm extends Component
{
    public string $first_name = '';
    public string $last_name = '';
    public string $email = '';

    protected function rules(): array
    {
        return ContactRules::store();
    }

    public function save(CreateContact $createContact): void
    {
        $validated = $this->validate();

        $data = new ContactData(
            firstName: $validated['first_name'],
            lastName: $validated['last_name'],
            email: $validated['email'],
        );

        $createContact->handle($data);

        session()->flash('success', 'Contact was saved.');

        $this->reset(['first_name', 'last_name', 'email']);

        $this->redirectRoute('contacts.index', navigate: true);
    }

    public function render(): View
    {
        return view('components.contacts.create-contact-form');
    }
}
