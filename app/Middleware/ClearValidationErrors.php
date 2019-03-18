<?php

namespace App\Middleware;

use App\Session\SessionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ClearValidationErrors implements MiddlewareInterface
{
    /**
     * @var SessionInterface
     */
    protected $session;

    /**
     * ClearValidationErrors constructor.
     * @param SessionInterface $session
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @inheritdoc
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $this->session->clear('errors', 'old');

        return $handler->handle($request);
    }
}
