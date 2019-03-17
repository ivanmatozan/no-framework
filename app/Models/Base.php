<?php

namespace App\Models;

abstract class Base
{
    /**
     * @param string $name
     * @return mixed
     */
    public function __get(string $name)
    {
        if (isset($this->$name)) {
            return $this->$name;
        }
    }

    /**
     * @param string $name
     * @return bool
     */
    public function __isset(string $name): bool
    {
        return property_exists($this, $name);
    }
}
