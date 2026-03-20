<?php declare(strict_types=1);

namespace App\Contact\DTO;

use App\Contact\Models\Contact;

final readonly class ContactData
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            firstName: $data['first_name'],
            lastName: $data['last_name'],
            email: $data['email'],
        );
    }


    public function toArray(): array
    {
        return [
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
        ];
    }
}
