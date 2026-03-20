<?php declare(strict_types=1);

namespace App\Contact\Services\Import;

use App\Contact\DTO\ContactData;
use Generator;
use XMLReader;

final class XmlContactReader
{
    public function read(string $absolutePath): Generator
    {
        $reader = new XMLReader;

        if (! $reader->open($absolutePath, 'UTF-8')) {
            throw new \RuntimeException(sprintf('Cannot open XML file: %s', $absolutePath));
        }

        try {
            while ($reader->read()) {
                if ($reader->nodeType !== XMLReader::ELEMENT || $reader->name !== 'item') {
                    continue;
                }

                $xml = $reader->readOuterXml();

                if ($xml === '') {
                    continue;
                }

                $element = simplexml_load_string($xml);

                if ($element === false) {
                    continue;
                }

                yield ContactData::fromArray([
                    'first_name' => trim((string) $element->first_name),
                    'last_name' => trim((string) $element->last_name),
                    'email' => strtolower(trim((string) $element->email)),
                ]);
            }
        } finally {
            $reader->close();
        }
    }
}
