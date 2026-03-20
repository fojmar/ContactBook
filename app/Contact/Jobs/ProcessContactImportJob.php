<?php declare(strict_types=1);

namespace App\Contact\Jobs;

use App\Contact\Actions\ProcessContactImport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

final class ProcessContactImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $timeout = 3600;

    public function __construct(
        public readonly int $contactImportId,
    ) {}

    public function handle(ProcessContactImport $processContactImport): void
    {
        $processContactImport->handle($this->contactImportId);
    }
}
