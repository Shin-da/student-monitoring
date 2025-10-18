<?php
// Define base paths
define('BASE_PATH', dirname(__FILE__));
define('APP_PATH', BASE_PATH . DIRECTORY_SEPARATOR . 'app');

require_once 'app/bootstrap.php';

echo "<h1>Server Environment Debug</h1>";
echo "<p><strong>SERVER_SOFTWARE:</strong> " . ($_SERVER['SERVER_SOFTWARE'] ?? 'Not set') . "</p>";
echo "<p><strong>SCRIPT_FILENAME:</strong> " . ($_SERVER['SCRIPT_FILENAME'] ?? 'Not set') . "</p>";
echo "<p><strong>Base path:</strong> " . \Helpers\Url::basePath() . "</p>";
echo "<p><strong>Asset URL for app.css:</strong> " . \Helpers\Url::asset('app.css') . "</p>";
echo "<p><strong>Asset URL for assets/app.css:</strong> " . \Helpers\Url::asset('assets/app.css') . "</p>";
?>
