<?php declare(strict_types=1);

namespace App\Contact\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 * @property int $id
 * @property string $email
 * @property string|null $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Contact extends Model
{
    use Searchable;

    protected $fillable = [
        'email',
        'first_name',
        'last_name',
    ];

    protected function email(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtolower($value),
        );
    }

    public function searchableAs(): string
    {
        return 'contacts';
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'full_name' => trim($this->first_name.' '.$this->last_name),
        ];
    }
}
