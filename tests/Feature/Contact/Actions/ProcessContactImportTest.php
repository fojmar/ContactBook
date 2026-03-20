<?php

use App\Contact\Actions\ProcessContactImport;
use App\Contact\Enums\ImportStatus;
use App\Contact\Models\Contact;
use App\Contact\Models\ContactImport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

it('processes xml import and stores stats', function () {
    Storage::fake('local');

    Storage::disk('local')->put(
        'contact-imports/test.xml',
        <<<'XML'
<?xml version="1.0" encoding="UTF-8"?>
<data>
  <item>
    <email>smith@example.com</email>
    <first_name>John</first_name>
    <last_name>Smith</last_name>
  </item>
  <item>
    <email>invalid-email</email>
    <first_name>Bad</first_name>
    <last_name>User</last_name>
  </item>
</data>
XML
    );

    $import = ContactImport::query()->create([
        'original_filename' => 'test.xml',
        'stored_path' => 'contact-imports/test.xml',
        'status' => ImportStatus::Pending->value,
    ]);

    app(ProcessContactImport::class)->handle($import->id);

    expect(Contact::query()->count())->toBe(1);

    $import->refresh();

    expect($import->status)->toBe(ImportStatus::Finished->value)
        ->and($import->total_records)->toBe(2)
        ->and($import->processed_records)->toBe(2)
        ->and($import->imported_records)->toBe(1)
        ->and($import->invalid_records)->toBe(1);
});
