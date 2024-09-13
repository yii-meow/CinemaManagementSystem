<?php

// bootstrap.php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require_once "vendor/autoload.php";
// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = true;
$proxyDir = null;
$cache = null;
$useSimpleAnnotationReader = false;
$config = ORMSetup::createAttributeMetadataConfiguration(
    [__DIR__."/app/models"],
    $isDevMode,
    $proxyDir,
    $cache,
    $useSimpleAnnotationReader
);

// configuring the database connection
$connection = DriverManager::getConnection([
    'driver' => 'pdo_mysql',
    'host' => 'cinema-management-system.cl9dstv2z9by.us-east-1.rds.amazonaws.com',
    'dbname' => 'CinemaManagementSystem',
    'user' => 'nbuser',
    'password' => 'cinemasystem0123',
], $config);

// obtaining the entity manager
$entityManager = new EntityManager($connection, $config);
