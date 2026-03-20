<?php declare(strict_types=1);

namespace App\Contact\Enums;

enum ImportStatus: string
{
    case Pending = 'pending';
    case Processing = 'processing';
    case Finished = 'finished';
    case Failed = 'failed';
}
