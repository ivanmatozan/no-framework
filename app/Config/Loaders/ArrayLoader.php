<?php

namespace App\Config\Loaders;

/**
 * Class ArrayLoader
 * @package App\Config\Loaders
 */
class ArrayLoader implements LoaderInterface
{
    /**
     * @var array
     */
    protected $files;

    /**
     * ArrayLoader constructor.
     * @param array $files
     */
    public function __construct(array $files)
    {
        $this->files = $files;
    }

    /**
     * @inheritdoc
     */
    public function parse(): array
    {
        $parsed = [];

        foreach ($this->files as $namespace => $path) {
            try {
                $parsed[$namespace] = require $path;
            } catch (\Exception $e) {
                //
            }
        }

        return $parsed;
    }
}
