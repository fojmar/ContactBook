<?php

use App\Contact\Services\Import\XmlContactReader;

it('can parse a valid contacts xml string', function () {
    $xmlContent = <<<'XML'
    <?xml version="1.0" encoding="UTF-8"?>
    <data>
        <item>
            <email>john.smith@example.com</email>
            <first_name>John</first_name>
            <last_name>Smith</last_name>
        </item>
        <item>
            <email>adam.smith@example.com</email>
            <first_name>Adam</first_name>
            <last_name>Smith</last_name>
        </item>
    </data>
    XML;

    $path = tempnam(sys_get_temp_dir(), 'contacts_');
    file_put_contents($path, $xmlContent);

    try {
        $reader = new XmlContactReader;

        $results = iterator_to_array($reader->read($path), false);

        expect($results)->toHaveCount(2)
            ->and($results[0]->toArray()['email'])->toBe('john.smith@example.com')
            ->and($results[1]->toArray()['first_name'])->toBe('Adam')
            ->and($results[1]->toArray()['last_name'])->toBe('Smith');
    } finally {
        @unlink($path);
    }
});

it('throws runtime exception if file does not exist', function () {
    $reader = new XmlContactReader;

    expect(fn () => iterator_to_array($reader->read('/non/existent/path.xml')))
        ->toThrow(RuntimeException::class, 'Cannot open XML file');
});
