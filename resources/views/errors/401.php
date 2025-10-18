<?php
/**
 * 401 Unauthorized Error Page
 */
$errorCode = 401;
$errorTitle = 'Unauthorized Access';
$errorMessage = 'You need to be logged in to access this page.';
$errorDescription = 'Please log in with your credentials to continue.';
$showHomeButton = true;
$showContactButton = false;

include 'error-template.php';
?>
