<?php

// bootstrap.php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require_once "vendor/autoload.php";

// Create a simple "default" Doctrine ORM configuration for Annotations
$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: array(__DIR__ . "/app/models"),
    isDevMode: true,
);

// configuring the database connection
$connection = DriverManager::getConnection([
    'driver' => 'pdo_mysql',
    'host' => 'localhost',
    'dbname' => 'your_database_name',
    'user' => 'your_username',
    'password' => 'your_password',
], $config);

// obtaining the entity manager
$entityManager = new EntityManager($connection, $config);
