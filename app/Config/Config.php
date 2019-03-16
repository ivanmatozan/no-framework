<?php

namespace App\Config;

use App\Config\Loaders\LoaderInterface;

/**
 * Class Config
 * @package App\Config
 */
class Config
{
    /**
     * @var array
     */
    protected $config = [];

    /**
     * @var array
     */
    protected $cache = [];

    /**
     * @param LoaderInterface ...$loaders
     * @return Config
     */
    public function load(LoaderInterface ...$loaders): self
    {
        $config[] = $this->config;

        foreach ($loaders as $loader) {
            $config[] = $loader->parse();
        }

        $this->config = array_merge(...$config);
        return $this;
    }

    /**
     * @param string $key
     * @param null $default
     * @return array|mixed|null
     */
    public function get(string $key, $default = null)
    {
        if (isset($this->cache[$key])) {
            return $this->cache[$key];
        }

        $filtered = $this->config;

        foreach (explode('.', $key) as $segment) {
            if ($this->exists($filtered, $segment)) {
                $filtered = $filtered[$segment];
                continue;
            }

            $this->cache[$key] = $default;
            return $default;
        }

        $this->cache[$key] = $filtered;
        return $filtered;
    }

    /**
     * @param array $config
     * @param string $key
     * @return bool
     */
    protected function exists(array $config, string $key): bool
    {
        return array_key_exists($key, $config);
    }
}
