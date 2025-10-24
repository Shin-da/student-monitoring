<?php
// Debug URL generation
require_once __DIR__ . '/app/Helpers/Url.php';

echo "Script Name: " . ($_SERVER['SCRIPT_NAME'] ?? 'not set') . "\n";
echo "Script Filename: " . ($_SERVER['SCRIPT_FILENAME'] ?? 'not set') . "\n";
echo "Document Root: " . ($_SERVER['DOCUMENT_ROOT'] ?? 'not set') . "\n";
echo "Request URI: " . ($_SERVER['REQUEST_URI'] ?? 'not set') . "\n\n";

echo "Base Path: " . \Helpers\Url::basePath() . "\n";
echo "To /login: " . \Helpers\Url::to('/login') . "\n";
echo "Asset app.css: " . \Helpers\Url::asset('app.css') . "\n";
echo "Asset assets/app.css: " . \Helpers\Url::asset('assets/app.css') . "\n";
echo "Public manifest.json: " . \Helpers\Url::publicPath('manifest.json') . "\n";
