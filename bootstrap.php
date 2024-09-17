<?php
// bootstrap.php
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\Tools\Setup;
use Dotenv\Dotenv;

require_once "vendor/autoload.php";

// Load environment variables from .env file
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Create a simple "default" Doctrine ORM configuration for Attributes
$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [__DIR__ . '/app/models'],
    isDevMode: true,
);


// Database connections configuration
$connections = [
    'readonly' => [
        'driver'   => 'pdo_mysql',
        'host'     => $_ENV['DB_HOST'],
        'dbname'   => $_ENV['DB_NAME'],
        'user'     => $_ENV['DB_USER_READONLY'],
        'password' => $_ENV['DB_PASSWORD_READONLY'],
    ],
    'regular' => [
        'driver'   => 'pdo_mysql',
        'host'     => $_ENV['DB_HOST'],
        'dbname'   => $_ENV['DB_NAME'],
        'user'     => $_ENV['DB_USER_REGULAR'],
        'password' => $_ENV['DB_PASSWORD_REGULAR'],
    ],
    'admin' => [
        'driver'   => 'pdo_mysql',
        'host'     => $_ENV['DB_HOST'],
        'dbname'   => $_ENV['DB_NAME'],
        'user'     => $_ENV['DB_USER_ADMIN'],
        'password' => $_ENV['DB_PASSWORD_ADMIN'],
    ]
];
// Determine the role (you can dynamically set this based on application logic)
// For example, set to 'admin' for administrator access
$role = 'regular'; // This can be dynamically set based on user role

// Get the appropriate connection parameters
$connectionParams = $connections[$role] ?? $connections['readonly']; // Fallback to 'regular' if role not found

// Create the Connection
$connection = DriverManager::getConnection($connectionParams);

// Create the EntityManager
$entityManager = EntityManager::create($connection, $config);


//// Default
//// configuring the database connection
//$connection = DriverManager::getConnection([
//    'driver' => 'pdo_mysql',
//    'host' => 'cinema-management-system.cl9dstv2z9by.us-east-1.rds.amazonaws.com',
//    'dbname' => 'CinemaManagementSystem',
//    'user' => 'nbuser',
//    'password' => 'cinemasystem0123',
//], $config);
//
//// obtaining the entity manager
//$entityManager = new EntityManager($connection, $config);
