<?php
/**
 * 403 Forbidden Error Page
 */
$errorCode = 403;
$errorTitle = 'Access Forbidden';
$errorMessage = 'You do not have permission to access this resource.';
$errorDescription = 'This area is restricted. Please contact an administrator if you believe you should have access.';
$showHomeButton = true;
$showContactButton = true;

include 'error-template.php';
?>
