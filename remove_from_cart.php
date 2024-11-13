<?php
session_start();
include 'config.php'; // Include the database connection file

// Ensure the user is logged in
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if (!$user_id) {
    echo 'Error: User not logged in.';
    exit;
}

// Get the cart ID from the URL
$cart_id = isset($_GET['cart_id']) ? intval($_GET['cart_id']) : 0;

if ($cart_id > 0) {
    // Prepare and execute the delete statement
    $sql = "DELETE FROM cart WHERE cart_id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $cart_id, $user_id);
    
    if ($stmt->execute()) {
        header("Location: cart.php"); // Redirect back to the cart page after deletion
        exit;
    } else {
        echo "Error: Could not delete item from cart.";
    }
} else {
    echo "Invalid cart ID.";
}

$conn->close();
?>
