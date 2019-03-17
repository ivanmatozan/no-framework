<?php

namespace App\Controllers\Auth;

use League\Route\Router;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use App\Controllers\Controller;
use App\Views\View;
use App\Auth\Auth;

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
     * LoginController constructor.
     * @param View $view
     * @param Auth $auth
     * @param Router $router
     */
    public function __construct(
        View $view,
        Auth $auth,
        Router $router
    ) {
        $this->view = $view;
        $this->auth = $auth;
        $this->router = $router;
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

        $this->auth->attempt($data['email'], $data['password']);

        return redirect($this->router->getNamedRoute('home')->getPath());
    }
}
