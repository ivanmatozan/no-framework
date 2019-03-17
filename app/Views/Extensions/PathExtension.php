<?php

namespace App\Views\Extensions;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use League\Route\Router;

class PathExtension extends AbstractExtension
{
    /**
     * @var Router
     */
    protected $router;

    /**
     * PathExtension constructor.
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * @inheritdoc
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('route', [$this, 'route'])
        ];
    }

    /**
     * @param string $name
     * @return string
     */
    public function route(string $name): string
    {
        return $this->router->getNamedRoute($name)->getPath();
    }
}
