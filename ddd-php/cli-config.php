<?php
// cli-config.php

use App\Infrastructure\Helpers\EntityManagerFactory;

require_once __DIR__ . '/vendor/autoload.php';

$entityManager = EntityManagerFactory::getEntityManager();

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);
