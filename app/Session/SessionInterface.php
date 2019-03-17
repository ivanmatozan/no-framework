<?php

namespace App\Session;

interface SessionInterface
{
    /**
     * @param string $key
     * @param null $default
     * @return mixed|null
     */
    public function get(string $key, $default = null);

    /**
     * @param string $key
     * @param $value
     * @return mixed
     */
    public function set(string $key, $value);

    /**
     * @param array $values
     */
    public function setMultiple(array $values): void;

    /**
     * @param string $key
     * @return bool
     */
    public function exists(string $key): bool;

    /**
     * @param string ...$key
     */
    public function clear(string ...$key): void;
}
