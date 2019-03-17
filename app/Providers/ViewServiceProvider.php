<?php

namespace App\Providers;

use League\Container\ServiceProvider\AbstractServiceProvider;
use Psr\Http\Message\ResponseInterface;
use League\Route\Router;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use App\Views\View;
use App\Views\Extensions\ConfigExtension;
use App\Views\Extensions\PathExtension;

/**
 * Class ViewServiceProvider
 * @package App\Providers
 */
class ViewServiceProvider extends AbstractServiceProvider
{
    /**
     * @var array
     */
    protected $provides = [
        View::class
    ];

    /**
     * @inheritDoc
     */
    public function register(): void
    {
        /** @var \League\Container\Container $container */
        $container = $this->getContainer();
        /** @var \App\Config\Config $config */
        $config = $container->get('config');

        $container->share(View::class, function () use ($container, $config) {
            $loader = new FilesystemLoader(BP . '/views');

            $twig = new Environment($loader, [
                'cache' => $config->get('cache.views.path'),
                'debug' => $config->get('app.debug')
            ]);

            if ($config->get('app.debug')) {
                $twig->addExtension(new DebugExtension());
            }

            $twig->addExtension(new ConfigExtension($config));
            $twig->addExtension(new PathExtension($container->get(Router::class)));

            return new View($twig, $container->get(ResponseInterface::class));
        });
    }
}
