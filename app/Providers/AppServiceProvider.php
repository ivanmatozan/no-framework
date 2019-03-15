<?php

namespace App\Providers;

use League\Container\ServiceProvider\AbstractServiceProvider;

/**
 * Class AppServiceProvider
 * @package App\Providers
 */
class AppServiceProvider extends AbstractServiceProvider
{
    /**
     * @inheritDoc
     */
    public function register()
    {
        /** @var \League\Container\Container $container */
        $container = $this->getContainer();
    }
}
