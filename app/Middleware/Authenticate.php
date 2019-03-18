<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use App\Auth\Auth;
use App\Views\View;

class Authenticate implements MiddlewareInterface
{
    /**
     * @var Auth
     */
    protected $auth;

    /**
     * @var View
     */
    protected $view;

    /**
     * Authenticate constructor.
     * @param Auth $auth
     * @param View $view
     */
    public function __construct(Auth $auth, View $view)
    {
        $this->auth = $auth;
        $this->view = $view;
    }

    /**
     * @inheritdoc
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $this->view->share(['auth' => $this->auth]);
        return $handler->handle($request);
    }
}
