<?php
session_start(); // Start the session to access session data

// Destroy the session data
session_unset();
session_destroy();

// Redirect to the home page or login page
header("Location: home.php");
exit();
?>
