<?php

namespace App\Views\Extensions;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use App\Config\Config;

class ConfigExtension extends AbstractExtension
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * PathExtension constructor.
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @inheritdoc
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('config', [$this, 'config'])
        ];
    }

    /**
     * @param string $key
     * @param null $default
     * @return array|mixed|null
     */
    public function config(string $key, $default = null)
    {
        return $this->config->get($key, $default);
    }
}
