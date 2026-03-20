<?php

use App\Contact\Models\Contact;
use App\Contact\UI\Livewire\CreateContactForm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('creates a contact', function () {
    Livewire::test(CreateContactForm::class)
        ->set('first_name', 'Adam')
        ->set('last_name', 'Smith')
        ->set('email', 'adam.smith@example.com')
        ->call('save')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('contacts', [
        'email' => 'adam.smith@example.com',
        'first_name' => 'Adam',
        'last_name' => 'Smith',
    ]);
});

it('fails without email', function () {
    Livewire::test(CreateContactForm::class)
        ->set('first_name', 'Adam')
        ->set('last_name', 'Smith')
        ->set('email', '')
        ->call('save')
        ->assertHasErrors(['email']);
});

it('fails when email already exists', function () {
    Contact::create([
        'first_name' => 'Adam',
        'last_name' => 'Smith',
        'email' => 'adam.smith@example.com',
    ]);

    Livewire::test(CreateContactForm::class)
        ->set('first_name', 'John')
        ->set('last_name', 'Smith')
        ->set('email', 'adam.smith@example.com')
        ->call('save')
        ->assertHasErrors(['email']);
});
