<?php

use App\Contact\Models\Contact;
use App\Contact\UI\Livewire\EditContactForm;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);
it('updates a contact', function () {
    $contact = Contact::create([
        'first_name' => 'Old',
        'last_name' => 'Name',
        'email' => 'old@example.com',
    ]);

    Livewire::test(EditContactForm::class, [
        'contact' => $contact,
    ])
        ->set('first_name', 'New')
        ->set('last_name', 'Name')
        ->set('email', 'new@example.com')
        ->call('save')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('contacts', [
        'id' => $contact->id,
        'first_name' => 'New',
        'email' => 'new@example.com',
    ]);
});

it('fails when updating to an email used by another contact', function () {
    $contactA = Contact::create([
        'first_name' => 'One',
        'last_name' => 'Name',
        'email' => 'a@example.com',
    ]);

    $contactB = Contact::create([
        'first_name' => 'Second',
        'last_name' => 'Name',
        'email' => 'b@example.com',
    ]);

    Livewire::test(EditContactForm::class, [
        'contact' => $contactA,
    ])
        ->set('first_name', 'John')
        ->set('last_name', 'Smith')
        ->set('email', 'b@example.com')
        ->call('save')
        ->assertHasErrors(['email']);

    $this->assertDatabaseHas('contacts', [
        'id' => $contactA->id,
        'email' => 'a@example.com',
    ]);
});
