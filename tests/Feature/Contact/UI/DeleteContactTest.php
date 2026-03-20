<?php

use App\Contact\Actions\DeleteContact;
use App\Contact\Models\Contact;
use App\Contact\UI\Livewire\ContactList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('deletes a contact from the list', function () {
    $contact = Contact::create(
        ['first_name' => 'Adam', 'last_name' => 'Smith', 'email' => 'adam.smith@example.com']
    );

    Livewire::test(ContactList::class)
        ->call('delete', $contact->id);

    $this->assertDatabaseMissing('contacts', [
        'id' => $contact->id,
    ]);
});

it('does nothing when contact does not exist', function () {
    app(DeleteContact::class)->handle(999);

    expect(true)->toBeTrue();
});
