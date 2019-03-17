<?php

namespace App\Session;

class Session implements SessionInterface
{
    /**
     * @inheritDoc
     */
    public function get(string $key, $default = null)
    {
        if ($this->exists($key)) {
            return $_SESSION[$key];
        }

        return $default;
    }

    /**
     * @inheritDoc
     */
    public function set(string $key, $value)
    {
        return $_SESSION[$key] = $value;
    }

    /**
     * @inheritDoc
     */
    public function setMultiple(array $values): void
    {
        foreach ($values as $key => $value) {
            $this->set($key, $value);
        }
    }

    /**
     * @inheritDoc
     */
    public function exists(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    /**
     * @inheritDoc
     */
    public function clear(string ...$keys): void
    {
        foreach ($keys as $key) {
            unset($_SESSION[$key]);
        }
    }
}
