<?php

require_once BASE_PATH . '/bootstrap.php';
require_once BASE_PATH . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

$databases = [
    'pgHost' => $_ENV['PG_HOST'],
    'pgPort' => $_ENV['PG_PORT'],
    'pgUser' => $_ENV['PG_USER'],
    'pgPassword' => $_ENV['PG_PASS'],
    'pgDB' => $_ENV['PG_DB'],
    'mongoUri' => $_ENV['MONGO_URI'],
    'mongoDB' => $_ENV['MONGO_DB'],
    'envName' => $_ENV['ENV_NAME'] ?? 'development',
];
