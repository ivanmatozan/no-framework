<?php

namespace App\Controllers;

use Doctrine\ORM\EntityManager;
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
     * @var EntityManager
     */
    protected $em;

    /**
     * HomeController constructor.
     * @param View $view
     * @param EntityManager $em
     */
    public function __construct(View $view, EntityManager $em)
    {
        $this->view = $view;
        $this->em = $em;
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function index(RequestInterface $request): ResponseInterface
    {
        $user = $this->em->getRepository(\App\Models\User::class)->find(1);

        return $this->view->render('home.twig', [
            'user' => $user
        ]);
    }
}
