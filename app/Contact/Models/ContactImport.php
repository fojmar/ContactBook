<?php declare(strict_types=1);

namespace App\Contact\Models;

use Illuminate\Database\Eloquent\Model;

class ContactImport extends Model
{
    protected $fillable = [
        'original_filename',
        'stored_path',
        'status',
        'total_records',
        'processed_records',
        'imported_records',
        'invalid_records',
        'started_at',
        'finished_at',
        'duration_ms',
        'error_message',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
    ];

    public function getDuplicateRecordsAttribute(): int
    {
        return max(0, $this->processed_records - $this->imported_records - $this->invalid_records);
    }
}
