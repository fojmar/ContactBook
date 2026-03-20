<?php declare(strict_types=1);

namespace App\Contact\Actions;

use App\Contact\DTO\ContactData;
use App\Contact\Enums\ImportStatus;
use App\Contact\Models\Contact;
use App\Contact\Models\ContactImport;
use App\Contact\Services\Import\ContactDataValidator;
use App\Contact\Services\Import\BatchProcessor;
use App\Contact\Services\Import\XmlContactReader;
use Illuminate\Support\Facades\Storage;
use Throwable;

final class ProcessContactImport
{
    private const int BATCH_SIZE = 1000;

    public function __construct(
        private readonly XmlContactReader     $xmlContactReader,
        private readonly ContactDataValidator $validator,
        private readonly BatchProcessor       $batchProcessor,
    ) {}

    public function handle(int $contactImportId): void
    {
        $import = ContactImport::query()->findOrFail($contactImportId);
        $startedAt = microtime(true);

        $import->update([
            'status' => ImportStatus::Processing->value,
            'started_at' => now(),
            'error_message' => null,
        ]);

        try {
            $absolutePath = Storage::path($import->stored_path);

            $batch = [];
            $totalRecords = 0;

            foreach ($this->xmlContactReader->read($absolutePath) as $row) {
                $totalRecords++;
                $batch[] = $row;

                if (count($batch) >= self::BATCH_SIZE) {
                    $this->flushBatch($import, $batch);
                    $batch = [];
                }
            }

            if ($batch !== []) {
                $this->flushBatch($import, $batch);
            }

            Contact::makeAllSearchable();
            $import->update([
                'total_records' => $totalRecords,
                'status' => ImportStatus::Finished->value,
                'finished_at' => now(),
                'duration_ms' => (int) round((microtime(true) - $startedAt) * 1000),
            ]);
        } catch (Throwable $e) {
            $import->update([
                'status' => ImportStatus::Failed->value,
                'finished_at' => now(),
                'duration_ms' => (int) round((microtime(true) - $startedAt) * 1000),
                'error_message' => $e->getMessage(),
            ]);

            throw $e;
        }
    }

    /**
     * @param  array<ContactData>  $batch
     */
    private function flushBatch(ContactImport $import, array $batch): void
    {
        $stats = $this->batchProcessor->process($batch, $this->validator);

        $import->increment('processed_records', $stats['processed']);
        $import->increment('imported_records', $stats['imported']);
        $import->increment('invalid_records', $stats['invalid']);
    }
}
