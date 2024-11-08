<?php
require __DIR__ . '/../vendor/autoload.php';

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\DBAL\DriverManager;
use Dotenv\Dotenv;

// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Configure paths and dev mode
$isDevMode = true;
$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [__DIR__ . '/src/Entity'],
    isDevMode:$_ENV['IS_DEV'] ,
);

// Database connection parameters
$params = [
    'driver' => 'pdo_mysql',
    'host' => $_ENV['DB_HOST'],
    'port' => $_ENV['DB_PORT'],
    'user' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASS'],
    'dbname' => $_ENV['DB_NAME'],
    'charset' => 'utf8mb4',
];

// Create connection and EntityManager
$connection = DriverManager::getConnection($params, $config);
$entityManager = new EntityManager($connection, $config);

return $entityManager;
