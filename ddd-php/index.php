<?php

use App\Domain\Helpers\EntityManagerFactory;

require_once __DIR__ . '/vendor/autoload.php';

$factory = new EntityManagerFactory();
$entityManager = $factory->getEntityManager();

var_dump($entityManager->getConnection());