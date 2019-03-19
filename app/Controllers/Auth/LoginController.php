<?php

namespace App\Controllers\Auth;

use League\Route\Router;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use App\Controllers\Controller;
use App\Views\View;
use App\Auth\Auth;
use App\Session\Flash;

class LoginController extends Controller
{
    /**
     * @var View
     */
    protected $view;

    /**
     * @var Auth
     */
    protected $auth;

    /**
     * @var Router
     */
    protected $router;

    /**
     * @var Flash
     */
    protected $flash;

    /**
     * LoginController constructor.
     * @param View $view
     * @param Auth $auth
     * @param Router $router
     * @param Flash $flash
     */
    public function __construct(
        View $view,
        Auth $auth,
        Router $router,
        Flash $flash
    ) {
        $this->view = $view;
        $this->auth = $auth;
        $this->router = $router;
        $this->flash = $flash;
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function index(RequestInterface $request): ResponseInterface
    {
        return $this->view->render('auth/login.twig');
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws \App\Exceptions\ValidationException
     */
    public function login(ServerRequestInterface $request): ResponseInterface
    {
        $data = $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (!$this->auth->attempt($data['email'], $data['password'])) {
            $this->flash->now('error', 'Could not login with those details.');
            return redirect($request->getUri()->getPath());
        }

        return redirect($this->router->getNamedRoute('home')->getPath());
    }
}
