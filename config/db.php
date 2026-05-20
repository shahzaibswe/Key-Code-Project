<?php
$db_file = __DIR__ . '/database.sqlite';
$is_sqlite = true;

try {
    if ($is_sqlite) {
        $pdo = new PDO("sqlite:$db_file");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Initialize tables if they don't exist
        $sql = file_get_contents(__DIR__ . '/../database.sql');
        $pdo->exec($sql);
    } else {
        // MySQL configuration placeholder
        $host = 'localhost';
        $db   = 'internship_portal';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
    }
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
