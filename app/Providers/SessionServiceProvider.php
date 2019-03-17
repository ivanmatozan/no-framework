<?php

namespace App\Providers;

use App\Session\Session;
use League\Container\ServiceProvider\AbstractServiceProvider;
use App\Session\SessionInterface;

class SessionServiceProvider extends AbstractServiceProvider
{
    /**
     * @var array
     */
    protected $provides = [
        SessionInterface::class
    ];

    /**
     * @inheritDoc
     */
    public function register(): void
    {
        /** @var \League\Container\Container $container */
        $container = $this->getContainer();

        $container->share(SessionInterface::class, Session::class);
    }
}
