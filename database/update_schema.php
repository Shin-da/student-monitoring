<?php
/**
 * Minimal Database Setup for Authentication Only
 * - Drops any existing auth-related tables
 * - Creates a single `users` table (id, name, email, role, password_hash, status, timestamps)
 * - Seeds one initial admin account
 */

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/Core/Database.php';

use Core\Database;

try {
    $config = require __DIR__ . '/../config/config.php';
    $pdo = Database::connection($config['database']);

    echo "🧹 Dropping existing tables if present...\n";

    // Helper to check if a table exists (avoid bound params in SHOW TABLES for MariaDB)
    $tableExists = function (string $table) use ($pdo): bool {
        $like = $pdo->quote($table); // safe quoting
        $sql = "SHOW TABLES LIKE $like";
        $stmt = $pdo->query($sql);
        return (bool)$stmt->fetchColumn();
    };

    // Drop everything we don't need now
    $maybeDrop = ['section_students','sections','parents','teachers','students','subjects','enrollments','user_profiles'];
    foreach ($maybeDrop as $tbl) {
        if ($tableExists($tbl)) {
            echo " - Dropping `$tbl`...\n";
            $pdo->exec("DROP TABLE `$tbl`");
        }
    }

    // Create users table fresh if needed
    if ($tableExists('users')) {
        echo " - Dropping existing `users` table to start clean...\n";
        $pdo->exec('DROP TABLE `users`');
    }

    echo "🛠️  Creating `users` table...\n";
    $pdo->exec("CREATE TABLE users (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(190) NOT NULL UNIQUE,
        role ENUM('admin','teacher','adviser','student','parent') NOT NULL,
        password_hash VARCHAR(255) NOT NULL,
        status ENUM('pending','active','suspended') NOT NULL DEFAULT 'active',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

    // Seed initial admin
    echo "🌱 Seeding initial admin...\n";
    $adminEmail = 'admin@school.edu';
    $adminPassword = 'Admin!is-me04';
    $adminName = 'System Administrator';
    $hash = password_hash($adminPassword, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare('INSERT INTO users (name, email, role, password_hash, status) VALUES (:name, :email, "admin", :hash, "active")');
    $stmt->execute(['name' => $adminName, 'email' => $adminEmail, 'hash' => $hash]);

    echo "✅ Minimal auth schema ready with one admin account.\n";

} catch (Exception $e) {
    echo "❌ Error updating schema: " . $e->getMessage() . "\n";
}
