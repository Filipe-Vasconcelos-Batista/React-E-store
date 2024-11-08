<?php
require __DIR__ . '/../vendor/autoload.php';

use Doctrine\DBAL\DriverManager;


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$params = [
    'driver' => 'pdo_mysql',
    'host' => $_ENV['DB_HOST'],
    'port' => $_ENV['DB_PORT'],
    'user' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASS'],
    'dbname' => $_ENV['DB_NAME'],
    'charset' => 'utf8mb4'
];

$connection = DriverManager::getConnection($params);

return $connection;
