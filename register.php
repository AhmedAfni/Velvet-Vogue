<?php
include 'config.php';

// Get JSON input and decode it
$input = json_decode(file_get_contents('php://input'), true);

// Check if all required fields are set
if (isset($input['fullName']) && isset($input['email']) && isset($input['homeAddress']) && 
    isset($input['postalCode']) && isset($input['password'])) {
    
    // Sanitize inputs
    $fullName = $input['fullName'];
    $email = $input['email'];
    $homeAddress = $input['homeAddress'];
    $postalCode = $input['postalCode'];
    $password = password_hash($input['password'], PASSWORD_DEFAULT);

    // Check if email already exists
    $check_sql = "SELECT id FROM users WHERE email = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Email already exists']);
    } else {
        // Insert new user
        $sql = "INSERT INTO users (full_name, email, home_address, postal_code, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $fullName, $email, $homeAddress, $postalCode, $password);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Registration successful! Please login.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Registration failed: ' . $conn->error]);
        }
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
}

$conn->close();
?>
