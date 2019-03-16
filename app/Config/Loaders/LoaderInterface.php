<?php

namespace App\Config\Loaders;

/**
 * Interface LoaderInterface
 * @package App\Config\Loaders
 */
interface LoaderInterface
{
    /**
     * @return array
     */
    public function parse(): array ;
}
