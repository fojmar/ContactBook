<?php declare(strict_types=1);

namespace App\Contact\Services\Import;

use App\Contact\DTO\ContactData;
use App\Contact\Validation\ContactRules;
use Illuminate\Support\Facades\Validator;

final class ContactDataValidator
{
    public function isValid(ContactData $data): bool
    {
        return !Validator::make(
            $data->toArray(),
            ContactRules::notUnique()
        )->fails();
    }
}
