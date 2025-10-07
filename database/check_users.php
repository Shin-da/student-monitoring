<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/Core/Database.php';

use Core\Database;

try {
    $config = require __DIR__ . '/../config/config.php';
    $pdo = Database::connection($config['database']);
    
    echo "Current users in database:\n";
    echo "========================\n";
    
    $stmt = $pdo->query('SELECT id, name, email, role, status FROM users ORDER BY id');
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "ID: {$row['id']}, Name: {$row['name']}, Email: {$row['email']}, Role: {$row['role']}, Status: {$row['status']}\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
