<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database configuration
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'velvet_vogue';

// Error reporting (comment these in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    // Create database connection
    $conn = new mysqli($host, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Set charset to handle special characters correctly
    $conn->set_charset("utf8mb4");
} catch (Exception $e) {
    die("Database connection error: " . $e->getMessage());
}

// Function to check if user is logged in and is admin
function checkAdminAuth() {
    if (!isset($_SESSION['admin_id'])) {
        header("Location: login.php?status=error&message=" . urlencode("Please login to access the admin panel."));
        exit();
    }
    
    // Optional: Check if the session is expired
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
        // Session expired after 30 minutes of inactivity
        session_unset();
        session_destroy();
        header("Location: login.php?status=error&message=" . urlencode("Session expired. Please login again."));
        exit();
    }
    
    // Update last activity time
    $_SESSION['last_activity'] = time();
}

// Function to sanitize input data
function sanitizeInput($data) {
    global $conn;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $conn->real_escape_string($data);
}

// Function to validate email
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to handle database errors
function handleDBError($query) {
    global $conn;
    error_log("MySQL Error: " . $conn->error . " in query: " . $query);
    return false;
}

// Set secure headers
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: SAMEORIGIN");
header("X-XSS-Protection: 1; mode=block");
?>
