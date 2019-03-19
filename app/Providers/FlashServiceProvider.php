<?php

namespace App\Providers;

use League\Container\ServiceProvider\AbstractServiceProvider;
use App\Session\Flash;
use App\Session\SessionInterface;

class FlashServiceProvider extends AbstractServiceProvider
{
    /**
     * @var array
     */
    protected $provides = [
        Flash::class
    ];

    /**
     * @inheritDoc
     */
    public function register(): void
    {
        /** @var \League\Container\Container $container */
        $container = $this->getContainer();

        $container->share(Flash::class, function () use ($container) {
            return new Flash($container->get(SessionInterface::class));
        });
    }
}
