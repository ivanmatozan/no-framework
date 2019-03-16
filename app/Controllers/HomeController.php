<?php

namespace App\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class HomeController
 * @package App\Controllers
 */
class HomeController
{
    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function index(RequestInterface $request): ResponseInterface
    {
        return new \Zend\Diactoros\Response\HtmlResponse('Test');
    }
}
