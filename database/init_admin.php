<?php
/**
 * Initialize Admin User Script
 * Run this script once to create the initial admin user
 */

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/Core/Database.php';

use Core\Database;

try {
    $config = require __DIR__ . '/../config/config.php';
    $pdo = Database::connection($config['database']);
    
    // Check if admin already exists
    $stmt = $pdo->prepare('SELECT id FROM users WHERE role = "admin" AND status = "active" LIMIT 1');
    $stmt->execute();
    
    if ($stmt->fetch()) {
        echo "Admin user already exists. Skipping creation.\n";
        exit(0);
    }
    
    // Create initial admin user
    $adminEmail = 'admin@school.edu';
    $adminPassword = 'Admin!is-me04'; // Change this in production!
    $adminName = 'System Administrator';
    
    $passwordHash = password_hash($adminPassword, PASSWORD_DEFAULT);
    
    $stmt = $pdo->prepare('
        INSERT INTO users (role, email, password_hash, name, status, approved_by, approved_at) 
        VALUES ("admin", :email, :hash, :name, "active", NULL, NOW())
    ');
    
    $result = $stmt->execute([
        'email' => $adminEmail,
        'hash' => $passwordHash,
        'name' => $adminName
    ]);
    
    if ($result) {
        echo "✅ Admin user created successfully!\n";
        echo "Email: {$adminEmail}\n";
        echo "Password: {$adminPassword}\n";
        echo "⚠️  Please change the password after first login!\n";
    } else {
        echo "❌ Failed to create admin user.\n";
    }
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
