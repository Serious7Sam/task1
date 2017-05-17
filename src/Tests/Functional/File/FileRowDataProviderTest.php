<?php

namespace Tests\Functional\File;

use File\FileRowDataProvider;
use PHPUnit\Framework\TestCase;

class FileRowDataProviderTest extends TestCase
{
    public function testGet()
    {
        $filePath = __DIR__ . '/test.csv';
        file_put_contents($filePath, "1, 5.5, meal1\n2, 6, meal1, meal2");

        $provider = new FileRowDataProvider($filePath);
        $rows = $provider->get();

        static::assertSame(['1', ' 5.5', ' meal1'], $rows->current());
        $rows->next();
        static::assertSame(['2', ' 6', ' meal1', ' meal2'], $rows->current());

        unlink($filePath);
    }
}
