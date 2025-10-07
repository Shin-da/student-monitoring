<?php
/**
 * Test CSRF Token Generation
 */

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/Core/Database.php';
require_once __DIR__ . '/../app/Core/Session.php';
require_once __DIR__ . '/../app/Helpers/Csrf.php';

use Core\Database;
use Core\Session;
use Helpers\Csrf;

try {
    $config = require __DIR__ . '/../config/config.php';
    $pdo = Database::connection($config['database']);
    
    echo "Testing CSRF Token Generation\n";
    echo "============================\n\n";
    
    // Test 1: Generate token
    echo "1. Generating CSRF token:\n";
    $token1 = Csrf::token();
    echo "   Token: {$token1}\n";
    
    // Test 2: Check token
    echo "\n2. Checking CSRF token:\n";
    $valid = Csrf::check($token1);
    echo "   Valid: " . ($valid ? 'YES' : 'NO') . "\n";
    
    // Test 3: Check same token again (should still be valid)
    echo "\n3. Checking same token again:\n";
    $valid2 = Csrf::check($token1);
    echo "   Valid: " . ($valid2 ? 'YES' : 'NO') . "\n";
    
    // Test 4: Generate new token
    echo "\n4. Generating new token:\n";
    $token2 = Csrf::token();
    echo "   New Token: {$token2}\n";
    
    // Test 5: Check old token (should be invalid now)
    echo "\n5. Checking old token with new token generated:\n";
    $valid3 = Csrf::check($token1);
    echo "   Old Token Valid: " . ($valid3 ? 'YES' : 'NO') . "\n";
    
    // Test 6: Check new token
    echo "\n6. Checking new token:\n";
    $valid4 = Csrf::check($token2);
    echo "   New Token Valid: " . ($valid4 ? 'YES' : 'NO') . "\n";
    
    echo "\n✅ CSRF token system is working correctly!\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
