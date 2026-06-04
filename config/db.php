<?php
// config/db.php

// For local verification in this environment, we use SQLite.
// In a production environment with MySQL, uncomment the MySQL section and comment the SQLite section.

/*
// MySQL Configuration
$host = '127.0.0.1';
$db   = 'internship_portal';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
*/

// SQLite Configuration (for verification)
$dsn = "sqlite:" . __DIR__ . "/../database.sqlite";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, null, null, $options);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
