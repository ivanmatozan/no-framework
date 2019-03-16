<?php

namespace App\Providers;

use League\Container\ServiceProvider\AbstractServiceProvider;
use App\Config\Config;
use App\Config\Loaders\ArrayLoader;

/**
 * Class ConfigServiceProvider
 * @package App\Providers
 */
class ConfigServiceProvider extends AbstractServiceProvider
{
    /**
     * @var array
     */
    protected $provides = [
        'config'
    ];

    /**
     * @inheritDoc
     */
    public function register(): void
    {
        /** @var \League\Container\Container $container */
        $container = $this->getContainer();

        $container->share('config', function () {
            $loader = new ArrayLoader([
                'app' => base_path('config/app.php'),
                'cache' => base_path('config/cache.php'),
            ]);

            return (new Config())->load($loader);
        });
    }
}
