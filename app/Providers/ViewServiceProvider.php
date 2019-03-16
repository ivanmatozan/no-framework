<?php

namespace App\Providers;

use League\Container\ServiceProvider\AbstractServiceProvider;
use Psr\Http\Message\ResponseInterface;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use App\Views\View;

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

        $container->share(View::class, function () use ($container) {
            $loader = new FilesystemLoader(BP . '/views');
            $twig = new Environment($loader, [
                'cache' => false
            ]);

            return new View($twig, $container->get(ResponseInterface::class));
        });
    }
}
