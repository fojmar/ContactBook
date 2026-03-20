<?php declare(strict_types=1);

namespace App\Contact\Actions;

use App\Contact\Models\Contact;

final class DeleteContact
{
    public function handle(int $id): bool
    {
        return Contact::findOrFail($id)->delete();
    }
}
