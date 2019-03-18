<?php

namespace App\Middleware;

use App\Session\SessionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use App\Views\View;

class ShareValidationErrors implements MiddlewareInterface
{
    /**
     * @var View
     */
    protected $view;

    /**
     * @var SessionInterface
     */
    protected $session;

    /**
     * ShareValidationErrors constructor.
     * @param View $view
     * @param SessionInterface $session
     */
    public function __construct(View $view, SessionInterface $session)
    {
        $this->view = $view;
        $this->session = $session;
    }

    /**
     * @inheritdoc
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $this->view->share([
            'errors' => $this->session->get('errors', []),
            'old' => $this->session->get('old', [])
        ]);

        return $handler->handle($request);
    }
}
