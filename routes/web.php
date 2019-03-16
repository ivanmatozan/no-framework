<?php

$router->get('/', function ($request) {
    return new \Zend\Diactoros\Response\HtmlResponse('Test');
});
