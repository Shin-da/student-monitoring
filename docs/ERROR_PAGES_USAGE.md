<?php
/**
 * Example usage of error pages in controllers
 */

// Example 1: Simple 404 redirect
\Helpers\ErrorHandler::notFound();

// Example 2: 404 with custom message
\Helpers\ErrorHandler::notFound('The requested student record was not found');

// Example 3: 403 with custom message
\Helpers\ErrorHandler::forbidden('You do not have permission to access this student\'s data');

// Example 4: 401 redirect
\Helpers\ErrorHandler::unauthorized('Please log in to continue');

// Example 5: 500 error
\Helpers\ErrorHandler::internalServerError('Database connection failed');

// Example 6: Generic error handler
try {
    // Some risky operation
    $result = riskyOperation();
} catch (\Exception $e) {
    \Helpers\ErrorHandler::handleError($e);
}

// Example 7: Manual redirect to error page with custom message
header('Location: ' . \Helpers\Url::to('/error/404?message=' . urlencode('Custom error message')));
exit;
?>
