<?php

namespace App\Views;

use Twig\Environment;
use Psr\Http\Message\ResponseInterface;

/**
 * Class View
 * @package App\Views
 */
class View
{
    /**
     * @var Environment
     */
    protected $twig;

    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * View constructor.
     * @param Environment $twig
     * @param ResponseInterface $response
     */
    public function __construct(Environment $twig, ResponseInterface $response)
    {
        $this->response = $response;
        $this->twig = $twig;
    }

    /**
     * @param string $template
     * @param array $data
     * @return ResponseInterface
     */
    public function render(string $template, array $data = []): ResponseInterface
    {
        try {
            $body = $this->twig->render($template, $data);
        } catch (\Twig\Error\Error $e) {
            $body = $e->getMessage();
        }

        $this->response->getBody()->write($body);
        return $this->response;
    }

    /**
     * @param array $data
     */
    public function share(array $data): void
    {
        foreach ($data as $key => $value) {
            $this->twig->addGlobal($key, $value);
        }
    }
}
