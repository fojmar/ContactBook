<?php declare(strict_types=1);

namespace App\Contact\UI\Livewire;

use App\Contact\Actions\StartContactImport;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImportContactsForm extends Component
{
    use WithFileUploads;

    public $file;

    public function save(StartContactImport $startContactImport): void
    {
        $validated = $this->validate([
            'file' => ['required', 'file', 'mimes:xml', 'max:102400'],
        ], [
            'file.required' => 'Select XML file.',
            'file.file' => 'Invalid file.',
            'file.mimes' => 'File must be XML file.',
            'file.max' => 'File is too large.',
        ]);

        $import = $startContactImport->handle($validated['file']);

        session()->flash('success', 'Import started.');

        $this->redirectRoute('contacts.imports.show', $import, navigate: true);
    }

    public function render()
    {
        return view('components.contacts.import-contacts-form');
    }
}
