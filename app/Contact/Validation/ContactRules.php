<?php declare(strict_types=1);

namespace App\Contact\Validation;

use App\Contact\Models\Contact;
use Illuminate\Validation\Rule;

final class ContactRules
{
    public static function store(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => [
                'required',
                'email:rfc',
                'max:255',
                Rule::unique('contacts', 'email'),
            ],
        ];
    }

    public static function update(Contact $contact): array
    {
        return [
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => [
                'required',
                'email:rfc',
                'max:255',
                Rule::unique('contacts', 'email')->ignore($contact),
            ],
        ];
    }

    public static function notUnique(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => [
                'required',
                'email:rfc',
                'max:255',
            ],
        ];
    }
}
