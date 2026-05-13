<?php
try {
     $pdo = new PDO('sqlite:' . __DIR__ . '/../database/aspire.sqlite');
     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
     $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (\PDOException $e) {
     die("Connection failed: " . $e->getMessage());
}
?>