<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use App\Views\View;
use App\Session\Flash;

class FlashMessages implements MiddlewareInterface
{
    /**
     * @var View
     */
    protected $view;

    /**
     * @var Flash
     */
    protected $flash;

    /**
     * FlashMessages constructor.
     * @param View $view
     * @param Flash $flash
     */
    public function __construct(View $view, Flash $flash)
    {
        $this->view = $view;
        $this->flash = $flash;
    }

    /**
     * @inheritdoc
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $this->view->share(['flash' => $this->flash]);
        return $handler->handle($request);
    }
}
