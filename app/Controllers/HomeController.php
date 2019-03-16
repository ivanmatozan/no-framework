<?php

namespace App\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use App\Views\View;

/**
 * Class HomeController
 * @package App\Controllers
 */
class HomeController
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
        return $this->view->render('home.twig', [
            'name' => 'Ivan'
        ]);
    }
}
