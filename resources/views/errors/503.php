<?php
/**
 * 503 Service Unavailable Error Page
 */
$errorCode = 503;
$errorTitle = 'Service Unavailable';
$errorMessage = 'The service is temporarily unavailable.';
$errorDescription = 'We are currently performing maintenance. Please try again in a few minutes.';
$showHomeButton = true;
$showContactButton = true;

include 'error-template.php';
?>
