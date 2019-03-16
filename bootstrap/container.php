<?php

$container = new \League\Container\Container();

$container->delegate(new \League\Container\ReflectionContainer());

$container->addServiceProvider(\App\Providers\AppServiceProvider::class);
$container->addServiceProvider(\App\Providers\ViewServiceProvider::class);
