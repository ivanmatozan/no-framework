<?php

define('BP', dirname(__DIR__));

require_once BP . '/bootstrap/app.php';

/** @var \Zend\HttpHandlerRunner\Emitter\EmitterInterface $emitter */
$emitter = $container->get('emitter');
$emitter->emit($response);
