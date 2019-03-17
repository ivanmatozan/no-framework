<?php

if (!function_exists('base_path')) {
    function base_path($path = '')
    {
        return dirname(__DIR__) . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if (!function_exists('env')) {
    function env($key, $default = null)
    {
        $value = getenv($key);

        if (false === $value) {
            return $default;
        }

        switch (strtolower($key)) {
            case $value === 'true':
                return true;
            case $value === 'false':
                return false;
            default:
                return $value;
        }
    }
}

if (!function_exists('redirect')) {
    function redirect(string $path): \Psr\Http\Message\ResponseInterface
    {
        return new \Zend\Diactoros\Response\RedirectResponse($path);
    }
}
