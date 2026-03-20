<?php declare(strict_types=1);
namespace App\Contact\Actions;

use App\Contact\DTO\ContactData;
use App\Contact\Models\Contact;

final class UpdateContact
{
    public function handle(Contact $contact, ContactData $data): Contact
    {
        $contact->update($data->toArray());

        return $contact->refresh();
    }
}
