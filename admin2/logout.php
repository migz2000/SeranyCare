<?php
// Start the session
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the sign-in page
header("Location: sign-in.php");
exit();
?>
