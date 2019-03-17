<?php

use App\Controllers\HomeController;

$router->get('/', [HomeController::class, 'index'])->setName('home');


use App\Controllers\Auth\LoginController;

$router->group('/auth', function (\League\Route\RouteGroup $router) {
    $router->get('/login', [LoginController::class, 'index'])->setName('auth.login');
    $router->post('/login', [LoginController::class, 'login']);
});
