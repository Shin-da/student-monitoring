<?php
// Handle profile picture upload for student
header('Content-Type: application/json');

// Define constants
define('BASE_PATH', dirname(__DIR__, 2));
define('APP_PATH', BASE_PATH . DIRECTORY_SEPARATOR . 'app');

// Simple autoloader for API
spl_autoload_register(function (string $class): void {
    $prefixes = [
        'Core' => APP_PATH . DIRECTORY_SEPARATOR . 'Core',
        'Controllers' => APP_PATH . DIRECTORY_SEPARATOR . 'Controllers',
        'Models' => APP_PATH . DIRECTORY_SEPARATOR . 'Models',
        'Helpers' => APP_PATH . DIRECTORY_SEPARATOR . 'Helpers',
        'App' => APP_PATH,
    ];

    foreach ($prefixes as $ns => $dir) {
        $nsPrefix = $ns . '\\';
        if (str_starts_with($class, $nsPrefix)) {
            $relative = substr($class, strlen($nsPrefix));
            $path = $dir . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $relative) . '.php';
            if (file_exists($path)) {
                require_once $path;
            }
            return;
        }
    }
});

// Load config
$config = require BASE_PATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';

// Start session
\Core\Session::start($config['session'] ?? []);

// Check if user is logged in and is a student
$user = \Core\Session::get('user');
if (!$user || !is_array($user) || ($user['role'] ?? '') !== 'student') {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access. Please log in as a student.']);
    exit;
}

// CSRF Protection
if (!\Helpers\Csrf::check($_POST['csrf_token'] ?? null)) {
    echo json_encode(['success' => false, 'message' => 'Invalid security token. Please refresh the page and try again.']);
    exit;
}

// Check if file is uploaded
if (!isset($_FILES['profile_picture']) || $_FILES['profile_picture']['error'] !== UPLOAD_ERR_OK) {
    $error_messages = [
        UPLOAD_ERR_INI_SIZE => 'File exceeds upload_max_filesize directive.',
        UPLOAD_ERR_FORM_SIZE => 'File exceeds MAX_FILE_SIZE directive.',
        UPLOAD_ERR_PARTIAL => 'File was only partially uploaded.',
        UPLOAD_ERR_NO_FILE => 'No file was uploaded.',
        UPLOAD_ERR_NO_TMP_DIR => 'Missing temporary folder.',
        UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk.',
        UPLOAD_ERR_EXTENSION => 'File upload stopped by extension.'
    ];
    
    $error_code = $_FILES['profile_picture']['error'] ?? UPLOAD_ERR_NO_FILE;
    $message = $error_messages[$error_code] ?? 'Unknown upload error.';
    
    echo json_encode(['success' => false, 'message' => $message]);
    exit;
}

$file = $_FILES['profile_picture'];

// Enhanced file validation
$allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
$allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
$max_size = 2 * 1024 * 1024; // 2MB

// Check file type
$file_type = mime_content_type($file['tmp_name']);
$file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

if (!in_array($file_type, $allowed_types) || !in_array($file_extension, $allowed_extensions)) {
    echo json_encode(['success' => false, 'message' => 'Invalid file type. Only JPG, PNG, GIF, and WebP images are allowed.']);
    exit;
}

// Check file size
if ($file['size'] > $max_size) {
    echo json_encode(['success' => false, 'message' => 'File too large. Maximum size is 2MB.']);
    exit;
}

// Additional security check - verify it's actually an image
$image_info = getimagesize($file['tmp_name']);
if ($image_info === false) {
    echo json_encode(['success' => false, 'message' => 'Invalid image file.']);
    exit;
}

// Generate unique filename with better security
$user_id = $user['id'];
$timestamp = time();
$random_string = bin2hex(random_bytes(8));
$filename = 'student_' . $user_id . '_' . $timestamp . '_' . $random_string . '.' . $file_extension;

// Define upload directory
$upload_dir = __DIR__ . '/../../public/assets/profile_pictures/';

// Ensure directory exists and is writable
if (!is_dir($upload_dir)) {
    if (!mkdir($upload_dir, 0755, true)) {
        echo json_encode(['success' => false, 'message' => 'Failed to create upload directory.']);
        exit;
    }
}

if (!is_writable($upload_dir)) {
    echo json_encode(['success' => false, 'message' => 'Upload directory is not writable.']);
    exit;
}

$target_path = $upload_dir . $filename;

// Move uploaded file
if (!move_uploaded_file($file['tmp_name'], $target_path)) {
    echo json_encode(['success' => false, 'message' => 'Failed to save file.']);
    exit;
}

// Set proper file permissions
chmod($target_path, 0644);

try {
    // Get database connection
    $config = require __DIR__ . '/../../config/config.php';
    $pdo = \Core\Database::connection($config['database']);
    
    // Update student profile picture path in database using user_id
    $image_url = '/assets/profile_pictures/' . $filename;
    
    // First, check if student record exists
    $checkStmt = $pdo->prepare('SELECT id FROM students WHERE user_id = ?');
    $checkStmt->execute([$user_id]);
    $student = $checkStmt->fetch();
    
    if (!$student) {
        // If no student record exists, create one
        $insertStmt = $pdo->prepare('INSERT INTO students (user_id, profile_picture, created_at, updated_at) VALUES (?, ?, NOW(), NOW())');
        $insertStmt->execute([$user_id, $image_url]);
    } else {
        // Update existing student record
        $updateStmt = $pdo->prepare('UPDATE students SET profile_picture = ?, updated_at = NOW() WHERE user_id = ?');
        $updateStmt->execute([$image_url, $user_id]);
    }
    
    // Log the activity
    error_log("Profile picture uploaded for user ID: $user_id, file: $filename");
    
    echo json_encode([
        'success' => true, 
        'image_url' => $image_url,
        'message' => 'Profile picture updated successfully!'
    ]);
    
} catch (\Exception $e) {
    // Clean up uploaded file if database update fails
    if (file_exists($target_path)) {
        unlink($target_path);
    }
    
    error_log("Profile picture upload error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Database update failed. Please try again.']);
}
