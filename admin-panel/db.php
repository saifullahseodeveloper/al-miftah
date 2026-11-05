<?php
// Custom CMS Database Connection (Supports MySQL and automatic local SQLite fallback)
if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
    @session_start();
}

$host = '127.0.0.1';
$dbname = 'u425598304_Koe3K';
$username = 'u425598304_XS72t';
$password = 'fVQJfXC1Ui';

$pdo = null;

try {
    // 1. Attempt connecting to MySQL (Production / Hostinger)
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_TIMEOUT => 2
    ]);
} catch (PDOException $e) {
    // 2. If MySQL is not reachable (e.g. offline local development), fallback to local SQLite database
    $sqlite_dir = __DIR__ . '/data';
    if (!is_dir($sqlite_dir)) {
        @mkdir($sqlite_dir, 0755, true);
    }
    $sqlite_file = $sqlite_dir . '/almiftah_local.sqlite';
    $pdo = new PDO("sqlite:" . $sqlite_file, null, null, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
}

// Auto-initialize tables and default data
require_once __DIR__ . '/init_schema.php';
ensure_database_schema($pdo);
