<?php

namespace App\Infrastructure\Helpers;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;

class EntityManagerFactory
{
    public static function getEntityManager(): EntityManagerInterface
    {
        $rootDir = __DIR__ . '/../../..';
        $isDevMode = true;
        $proxyDir = null;
        $cache = null;
        $useSimpleAnnotationReader = false;

        $config = Setup::createAnnotationMetadataConfiguration(
            [$rootDir . "/src"],
            $isDevMode,
            $proxyDir,
            $cache,
            $useSimpleAnnotationReader
        );

        $connection = [
            'driver' => 'pdo_sqlite',
            'path' => $rootDir . '/db.sqlite'
        ];

        return EntityManager::create($connection, $config);
    }
}