<?php
// Start the session
session_start();

// Destroy the session
session_unset();
session_destroy();

// Redirect to index.php with a success message
header("Location: index.php?message=You have successfully signed out.");
exit;
?>
