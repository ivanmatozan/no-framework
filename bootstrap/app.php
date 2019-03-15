<?php

session_start();

require_once BP . '/vendor/autoload.php';

try {
    \Dotenv\Dotenv::create(BP)->load();
} catch (\Dotenv\Exception\InvalidPathException $e) {
}
