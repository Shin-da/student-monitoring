<?php
/**
 * 500 Internal Server Error Page
 */
$errorCode = 500;
$errorTitle = 'Internal Server Error';
$errorMessage = 'Something went wrong on our end.';
$errorDescription = 'We are experiencing technical difficulties. Our team has been notified and is working to resolve this issue.';
$showHomeButton = true;
$showContactButton = true;

include 'error-template.php';
?>
