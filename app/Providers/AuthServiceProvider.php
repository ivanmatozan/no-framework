<?php

namespace App\Providers;

use League\Container\ServiceProvider\AbstractServiceProvider;
use Doctrine\ORM\EntityManager;
use App\Auth\Hashing\HasherInterface;
use App\Auth\Auth;
use App\Session\SessionInterface;

class AuthServiceProvider extends AbstractServiceProvider
{
    /**
     * @var array
     */
    protected $provides = [
        Auth::class
    ];

    /**
     * @inheritDoc
     */
    public function register(): void
    {
        /** @var \League\Container\Container $container */
        $container = $this->getContainer();

        $container->share(Auth::class, function () use ($container) {
            return new Auth(
                $container->get(EntityManager::class),
                $container->get(HasherInterface::class),
                $container->get(SessionInterface::class)
            );
        });
    }
}
