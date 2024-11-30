<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "velvet_vogue"; // Replace with your actual database name

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $email = $_POST['adminEmail'] ?? null;
    $password = $_POST['adminPassword'] ?? null;

    // Check if form data is valid
    if (!$email || !$password) {
        echo "Email and Password are required!";
        exit;
    }

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("SELECT password FROM admins WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            echo "Login successful!";
            // Redirect to admin dashboard or another page
            header("Location: dashboard.php");
            exit;
        } else {
            echo "Invalid email or password!";
        }
    } else {
        echo "Invalid email or password!";
    }

    // Close statement and connection
    $stmt->close();
}
$conn->close();
?>
