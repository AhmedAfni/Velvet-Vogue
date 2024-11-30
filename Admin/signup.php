<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "velvet_vogue"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['adminName'] ?? null;
    $email = $_POST['adminEmail'] ?? null;
    $password = $_POST['adminPassword'] ?? null;
    $confirmPassword = $_POST['confirmPassword'] ?? null;

    // Validate form inputs
    if (!$name || !$email || !$password || !$confirmPassword) {
        die("All fields are required!");
    }

    if ($password !== $confirmPassword) {
        die("Passwords do not match!");
    }

    // Check if email already exists
    $checkStmt = $conn->prepare("SELECT id FROM admins WHERE email = ?");
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        die("This email is already registered. Please use a different email.");
    }
    $checkStmt->close();

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("INSERT INTO admins (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $hashedPassword);

    if ($stmt->execute()) {
        echo "Signup successful!";
        // Redirect to login page
        header("Location: login.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
}
$conn->close();
?>
