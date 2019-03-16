<?php

namespace App\Providers;

use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Route\Router;
use League\Route\Strategy\ApplicationStrategy;
use Zend\Diactoros\ServerRequestFactory;
use Zend\Diactoros\Response;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;

/**
 * Class AppServiceProvider
 * @package App\Providers
 */
class AppServiceProvider extends AbstractServiceProvider
{
    /**
     * @var array
     */
    protected $provides = [
        Router::class,
        'request',
        'response',
        'emitter'
    ];

    /**
     * @inheritDoc
     */
    public function register()
    {
        /** @var \League\Container\Container $container */
        $container = $this->getContainer();

        $container->share(Router::class, function () use ($container) {
            $strategy = new ApplicationStrategy();
            $strategy->setContainer($container);

            return (new Router())->setStrategy($strategy);
        });

        $container->share('request', function () {
            return ServerRequestFactory::fromGlobals();
        });

        $container->share('response', Response::class);

        $container->share('emitter', SapiEmitter::class);
    }
}
