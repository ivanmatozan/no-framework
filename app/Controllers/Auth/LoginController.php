<?php

namespace App\Controllers\Auth;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use App\Controllers\Controller;
use App\Views\View;

class LoginController extends Controller
{
    /**
     * @var View
     */
    protected $view;

    /**
     * HomeController constructor.
     * @param View $view
     */
    public function __construct(View $view)
    {
        $this->view = $view;
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
        $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        return redirect('/');
    }
}
