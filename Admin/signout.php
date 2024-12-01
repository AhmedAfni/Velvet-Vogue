<?php
// Start the session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Clear all session data
$_SESSION = array();

// Destroy the session cookie
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}

// Destroy the session
session_destroy();

// Clear any sensitive cookies
setcookie('remember_me', '', time() - 3600, '/');
setcookie('admin_token', '', time() - 3600, '/');

// Prevent caching of sensitive pages
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Redirect to login page with a success message
header("Location: login.php?status=success&message=" . urlencode("You have been successfully logged out."));
exit();
?>
