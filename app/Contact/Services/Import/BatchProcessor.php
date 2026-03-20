<?php declare(strict_types=1);

namespace App\Contact\Services\Import;

use Illuminate\Support\Facades\DB;

final class BatchProcessor
{
    public function process(array $rows, ContactDataValidator $validator): array
    {
        $processed = count($rows);
        $invalid = 0;
        $rowsToInsert = [];
        $now = now();

        foreach ($rows as $row) {
            if (! $validator->isValid($row)) {
                $invalid++;
                continue;
            }

            $rowsToInsert[] = [
                'first_name' => $row->firstName,
                'last_name' => $row->lastName,
                'email' => $row->email,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        $imported = 0;

        if ($rowsToInsert !== []) {
            $imported = DB::table('contacts')->insertOrIgnore($rowsToInsert);
        }

        return [
            'processed' => $processed,
            'imported' => $imported,
            'invalid' => $invalid,
        ];
    }
}
