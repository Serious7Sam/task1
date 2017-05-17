<?php

namespace File;

class FileRowDataProvider implements FileRowDataProviderInterface
{
    /**
     * @var string
     */
    private $filePath;

    /**
     * @param string $filePath
     */
    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * {@inheritDoc}
     */
    public function get()
    {
        $file = fopen($this->filePath, 'rb');
        if ($file === false) {
            yield from [];
        }

        while (($data = fgetcsv($file, 0, ',')) !== false) {
            yield $data;
        }
    }
}
