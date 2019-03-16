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

require_once BP . '/routes/web.php';

$response = $router->dispatch($container->get('request'));
