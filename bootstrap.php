<?php
// bootstrap.php
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require_once "vendor/autoload.php";

// Create a simple "default" Doctrine ORM configuration for Attributes
$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [__DIR__ . '/app/models'],
    isDevMode: true,
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
