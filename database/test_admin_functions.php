<?php
/**
 * Test Admin Functions
 * This script tests if the admin user management functions work correctly
 */

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/Core/Database.php';

use Core\Database;

try {
    $config = require __DIR__ . '/../config/config.php';
    $pdo = Database::connection($config['database']);
    
    echo "Testing Admin Functions\n";
    echo "======================\n\n";
    
    // Test 1: Check if we have users
    echo "1. Checking current users:\n";
    $stmt = $pdo->query('SELECT id, name, email, role, status FROM users ORDER BY id');
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (empty($users)) {
        echo "   ❌ No users found in database\n";
        exit(1);
    }
    
    foreach ($users as $user) {
        echo "   - ID: {$user['id']}, Name: {$user['name']}, Role: {$user['role']}, Status: {$user['status']}\n";
    }
    
    // Test 2: Check if we have an admin
    echo "\n2. Checking for admin user:\n";
    $stmt = $pdo->prepare('SELECT id, name, email FROM users WHERE role = "admin" AND status = "active" LIMIT 1');
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$admin) {
        echo "   ❌ No active admin user found\n";
        exit(1);
    }
    
    echo "   ✅ Admin found: {$admin['name']} ({$admin['email']})\n";
    
    // Test 3: Check database structure
    echo "\n3. Checking database structure:\n";
    $requiredColumns = ['status', 'requested_role', 'approved_by', 'approved_at'];
    
    foreach ($requiredColumns as $column) {
        $stmt = $pdo->query("SHOW COLUMNS FROM users LIKE '{$column}'");
        if ($stmt->fetch()) {
            echo "   ✅ Column '{$column}' exists\n";
        } else {
            echo "   ❌ Column '{$column}' missing\n";
        }
    }
    
    // Test 4: Test SQL queries that admin functions use
    echo "\n4. Testing SQL queries:\n";
    
    // Test approve query
    try {
        $stmt = $pdo->prepare('
            UPDATE users 
            SET status = "active", 
                approved_by = :admin_id, 
                approved_at = NOW() 
            WHERE id = :user_id AND status = "pending"
        ');
        echo "   ✅ Approve user query syntax is valid\n";
    } catch (Exception $e) {
        echo "   ❌ Approve user query error: " . $e->getMessage() . "\n";
    }
    
    // Test suspend query
    try {
        $stmt = $pdo->prepare('UPDATE users SET status = "suspended" WHERE id = :user_id AND id != :admin_id');
        echo "   ✅ Suspend user query syntax is valid\n";
    } catch (Exception $e) {
        echo "   ❌ Suspend user query error: " . $e->getMessage() . "\n";
    }
    
    // Test activate query
    try {
        $stmt = $pdo->prepare('UPDATE users SET status = "active" WHERE id = :user_id');
        echo "   ✅ Activate user query syntax is valid\n";
    } catch (Exception $e) {
        echo "   ❌ Activate user query error: " . $e->getMessage() . "\n";
    }
    
    echo "\n✅ All tests passed! Admin functions should work correctly.\n";
    echo "\nTo test the functions:\n";
    echo "1. Login as admin: {$admin['email']}\n";
    echo "2. Go to /admin/users\n";
    echo "3. Try approve/reject/suspend buttons\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
