<?php
// Start session
session_start();

// Unset session variable
unset($_SESSION['loggedin']);

// Destroy session
session_destroy();

// Redirect to login page
header("Location: index.php");
exit;
?>
