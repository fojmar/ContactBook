<?php

use App\Contact\Jobs\ProcessContactImportJob;
use App\Contact\UI\Livewire\ImportContactsForm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('stores uploaded xml and dispatches import job', function () {
    Storage::fake('local');
    Queue::fake();

    $file = UploadedFile::fake()->createWithContent(
        'contacts.xml',
        <<<'XML'
<?xml version="1.0" encoding="UTF-8"?>
<data>
  <item>
    <email>john@example.com</email>
    <first_name>john</first_name>
    <last_name>Smith</last_name>
  </item>
</data>
XML
    );

    Livewire::test(ImportContactsForm::class)
        ->set('file', $file)
        ->call('save')
        ->assertHasNoErrors();

    $this->assertDatabaseCount('contact_imports', 1);

    Queue::assertPushed(ProcessContactImportJob::class);
});
