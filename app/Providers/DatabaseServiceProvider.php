<?php

namespace App\Providers;

use League\Container\ServiceProvider\AbstractServiceProvider;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

/**
 * Class DatabaseServiceProvider
 * @package App\Providers
 */
class DatabaseServiceProvider extends AbstractServiceProvider
{
    /**
     * @var array
     */
    protected $provides = [
        EntityManager::class
    ];

    /**
     * @inheritDoc
     */
    public function register(): void
    {
        /** @var \League\Container\Container $container */
        $container = $this->getContainer();
        /** @var \App\Config\Config $config */
        $config = $container->get('config');

        $container->share(EntityManager::class, function () use ($config) {
            $dbConfig = $config->get('db.' . env('DB_TYPE'));

            $em = EntityManager::create(
                $dbConfig,
                Setup::createAnnotationMetadataConfiguration(
                    [base_path('app')],
                    $config->get('app.debug'),
                    null,
                    null,
                    false
                )
            );

            return $em;
        });
    }
}
