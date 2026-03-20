<?php

use App\Contact\UI\Livewire\ContactList;
use App\Contact\UI\Livewire\CreateContactForm;
use App\Contact\UI\Livewire\EditContactForm;
use App\Contact\UI\Livewire\ImportContactsForm;
use App\Contact\UI\Livewire\ShowContactImport;
use Illuminate\Support\Facades\Route;
use function Pest\Laravel\get;

Route::redirect('/', '/contacts');

Route::get('contacts/', ContactList::class)->name('contacts.index');
Route::get('contacts/create', CreateContactForm::class)->name('contacts.create');
Route::get('contacts/{contact}/edit', EditContactForm::class)->name('contacts.edit');
Route::get('/contacts/import', ImportContactsForm::class)->name('contacts.import');
Route::get('/contacts/imports/{contactImport}', ShowContactImport::class)->name('contacts.imports.show');
