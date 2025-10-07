<?php
/**
 * Database Schema Update Script
 * Run this script to update existing database with new user management fields
 */

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/Core/Database.php';

use Core\Database;

try {
    $config = require __DIR__ . '/../config/config.php';
    $pdo = Database::connection($config['database']);
    
    echo "🔄 Updating database schema...\n";
    
    // Check if status column exists
    $stmt = $pdo->prepare("SHOW COLUMNS FROM users LIKE 'status'");
    $stmt->execute();
    
    if (!$stmt->fetch()) {
        echo "Adding status column...\n";
        $pdo->exec("ALTER TABLE users ADD COLUMN status ENUM('pending','active','suspended') DEFAULT 'pending'");
    }
    
    // Check if requested_role column exists
    $stmt = $pdo->prepare("SHOW COLUMNS FROM users LIKE 'requested_role'");
    $stmt->execute();
    
    if (!$stmt->fetch()) {
        echo "Adding requested_role column...\n";
        $pdo->exec("ALTER TABLE users ADD COLUMN requested_role ENUM('admin','teacher','adviser','student','parent') NULL");
    }
    
    // Check if approved_by column exists
    $stmt = $pdo->prepare("SHOW COLUMNS FROM users LIKE 'approved_by'");
    $stmt->execute();
    
    if (!$stmt->fetch()) {
        echo "Adding approved_by column...\n";
        $pdo->exec("ALTER TABLE users ADD COLUMN approved_by INT UNSIGNED NULL");
        $pdo->exec("ALTER TABLE users ADD FOREIGN KEY (approved_by) REFERENCES users(id)");
    }
    
    // Check if approved_at column exists
    $stmt = $pdo->prepare("SHOW COLUMNS FROM users LIKE 'approved_at'");
    $stmt->execute();
    
    if (!$stmt->fetch()) {
        echo "Adding approved_at column...\n";
        $pdo->exec("ALTER TABLE users ADD COLUMN approved_at TIMESTAMP NULL");
    }
    
    // Update existing users to active status
    echo "Updating existing users to active status...\n";
    $pdo->exec("UPDATE users SET status = 'active' WHERE status = 'pending'");
    
    // Check if parents table has student_id column
    $stmt = $pdo->prepare("SHOW COLUMNS FROM parents LIKE 'student_id'");
    $stmt->execute();
    
    if (!$stmt->fetch()) {
        echo "Adding student_id and relationship columns to parents table...\n";
        $pdo->exec("ALTER TABLE parents ADD COLUMN student_id INT UNSIGNED NULL");
        $pdo->exec("ALTER TABLE parents ADD COLUMN relationship ENUM('father','mother','guardian') DEFAULT 'guardian'");
        $pdo->exec("ALTER TABLE parents ADD FOREIGN KEY (student_id) REFERENCES students(id)");
    }
    
    echo "✅ Database schema updated successfully!\n";
    
} catch (Exception $e) {
    echo "❌ Error updating schema: " . $e->getMessage() . "\n";
}
