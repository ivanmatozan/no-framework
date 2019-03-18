<?php

session_start();

require_once BP . '/vendor/autoload.php';

try {
    \Dotenv\Dotenv::create(BP)->load();
} catch (\Dotenv\Exception\InvalidPathException $e) {
    //
}

require_once 'container.php';

/** @var \League\Route\Router $router */
$router = $container->get(\League\Route\Router::class);

require_once BP . '/bootstrap/middleware.php';
require_once BP . '/routes/web.php';

try {
    $response = $router->dispatch($container->get('request'));
} catch (\Exception $exception) {
    $handler = new \App\Exceptions\Handler(
        $exception,
        $container->get(\App\Session\SessionInterface::class)
    );

    $response = $handler->respond();
}
