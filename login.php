<?php
session_start(); // Start the session to manage user login state

include 'config.php'; // Include your database configuration

// Get JSON input and decode it
$input = json_decode(file_get_contents('php://input'), true);

// Check if email and password are set
if (isset($input['email']) && isset($input['password'])) {
    $email = $input['email'];
    $password = $input['password'];

    // Query to check if user exists
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Set session variables upon successful login
            $_SESSION['user_id'] = $user['id']; // Assume 'id' is the user's primary key in the users table
            $_SESSION['user_name'] = $user['full_name']; // Optional: store user's name for personalization
            
            // Send success response
            echo json_encode(['status' => 'success', 'message' => 'Login successful']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Incorrect password']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'User not found']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
}

$conn->close();
?>
