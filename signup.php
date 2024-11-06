<?php
// Set headers for JSON response
header('Content-Type: application/json');

// Include database configuration
require 'config.php';

// Initialize response
$response = ['success' => false, 'message' => ''];

// Validate request method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form inputs
    $fullName = trim($_POST['signupFullName']);
    $homeAddress = trim($_POST['signupHomeAddress']);
    $postalCode = trim($_POST['signupPostalCode']);
    $email = trim($_POST['signupEmail']);
    $password = $_POST['signupPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Validate form inputs
    if (empty($fullName) || empty($homeAddress) || empty($postalCode) || empty($email) || empty($password) || empty($confirmPassword)) {
        $response['message'] = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = "Please enter a valid email address.";
    } elseif ($password !== $confirmPassword) {
        $response['message'] = "Passwords do not match.";
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert user data into the database
        $sql = "INSERT INTO users (full_name, home_address, postal_code, email, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sssss", $fullName, $homeAddress, $postalCode, $email, $hashedPassword);

            if ($stmt->execute()) {
                $response['success'] = true;
            } else {
                $response['message'] = "Error: Unable to register. Please try again later.";
            }

            $stmt->close();
        } else {
            $response['message'] = "Error: Database connection failed.";
        }
    }
}

// Output response as JSON
echo json_encode($response);
?>
