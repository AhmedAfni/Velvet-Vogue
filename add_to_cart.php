<?php
session_start();
include 'config.php'; // Include the database connection file

// Ensure user is logged in (no guest users allowed)
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if ($user_id) {
    // Check if the product and size are set in the request
    if (isset($_POST['product_id']) && isset($_POST['size'])) {
        $product_id = $_POST['product_id'];
        $size = $_POST['size'];

        // Check if the product is already in the user's cart
        $check_cart_sql = "SELECT cart_id, quantity FROM cart WHERE user_id = ? AND product_id = ? AND size = ?";
        $stmt = $conn->prepare($check_cart_sql);
        $stmt->bind_param("iis", $user_id, $product_id, $size);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Product is already in the cart, update the quantity
            $row = $result->fetch_assoc();
            $new_quantity = $row['quantity'] + 1;

            $update_sql = "UPDATE cart SET quantity = ? WHERE cart_id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("ii", $new_quantity, $row['cart_id']);
            
            if ($update_stmt->execute()) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Product quantity updated in cart!'
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to update cart.'
                ]);
            }
        } else {
            // Product is not in the cart, insert a new record
            $quantity = 1;

            $insert_sql = "INSERT INTO cart (user_id, product_id, size, quantity) VALUES (?, ?, ?, ?)";
            $insert_stmt = $conn->prepare($insert_sql);
            $insert_stmt->bind_param("iisi", $user_id, $product_id, $size, $quantity);
            
            if ($insert_stmt->execute()) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Product added to cart!'
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to add product to cart.'
                ]);
            }
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Error: Product or size not specified.'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Please log in to add items to your cart',
        'requireLogin' => true,
        'loginUrl' => 'login_page.php'
    ]);
}

// Close the database connection
$conn->close();
?>
