<?php

namespace App\Providers;

use League\Container\ServiceProvider\AbstractServiceProvider;
use App\Auth\Hashing\HasherInterface;
use App\Auth\Hashing\BcryptHasher;

class HashServiceProvider extends AbstractServiceProvider
{
    /**
     * @var array
     */
    protected $provides = [
        HasherInterface::class
    ];

    /**
     * @inheritDoc
     */
    public function register(): void
    {
        /** @var \League\Container\Container $container */
        $container = $this->getContainer();

        $container->share(HasherInterface::class, BcryptHasher::class);
    }
}
