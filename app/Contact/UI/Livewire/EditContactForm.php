<?php declare(strict_types=1);

namespace App\Contact\UI\Livewire;

use App\Contact\Actions\UpdateContact;
use App\Contact\DTO\ContactData;
use App\Contact\Models\Contact;
use App\Contact\Validation\ContactRules;
use Illuminate\View\View;
use Livewire\Component;

class EditContactForm extends Component
{
    public Contact $contact;

    public string $first_name = '';

    public string $last_name = '';

    public string $email = '';

    protected function messages(): array
    {
        return [
            'email.unique' => 'Email already exists.',
        ];
    }

    public function mount(Contact $contact): void
    {
        $this->contact = $contact;

        $this->first_name = $contact->first_name;
        $this->last_name = $contact->last_name;
        $this->email = $contact->email;
    }

    public function save(UpdateContact $updateContact): void
    {
        $validated = $this->validate(ContactRules::update($this->contact));

        $data = ContactData::fromArray($validated);

        $updateContact->handle($this->contact, $data);

        session()->flash('success', 'Contact was updated.');

        $this->redirectRoute('contacts.index', navigate: true);
    }

    public function render(): View
    {
        return view('components.contacts.create-contact-form');
    }
}
