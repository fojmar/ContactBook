<?php declare(strict_types=1);

namespace App\Contact\Actions;

use App\Contact\Enums\ImportStatus;
use App\Contact\Jobs\ProcessContactImportJob;
use App\Contact\Models\ContactImport;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

final class StartContactImport
{
    public function handle(TemporaryUploadedFile $file): ContactImport
    {
        $path = $file->store('contact-imports');

        $import = ContactImport::create([
            'original_filename' => $file->getClientOriginalName(),
            'stored_path' => $path,
            'status' => ImportStatus::Pending->value,
        ]);

        ProcessContactImportJob::dispatch($import->id);

        return $import;
    }
}
