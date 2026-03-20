<?php declare(strict_types=1);

namespace App\Contact\Actions;

use App\Contact\DTO\ContactData;
use App\Contact\Models\Contact;

final class CreateContact
{
    public function handle(ContactData $data): Contact
    {
        return Contact::create($data->toArray());
    }
}
