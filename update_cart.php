<?php
session_start();
include 'config.php';

// Ensure user is logged in
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if (!$user_id) {
    echo json_encode([
        'success' => false,
        'message' => 'Please log in to update your cart'
    ]);
    exit;
}

// Get POST data
$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (!$data || !isset($data['cart_id']) || !isset($data['quantity'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request data'
    ]);
    exit;
}

$cart_id = intval($data['cart_id']);
$quantity = intval($data['quantity']);

// Validate quantity
if ($quantity < 1) {
    echo json_encode([
        'success' => false,
        'message' => 'Quantity must be at least 1'
    ]);
    exit;
}

try {
    // Update cart quantity
    $sql = "UPDATE cart SET quantity = ? WHERE cart_id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $quantity, $cart_id, $user_id);
    
    if ($stmt->execute()) {
        // Get updated cart item details
        $get_item_sql = "SELECT c.quantity, p.price, p.product_name 
                        FROM cart c 
                        JOIN products p ON c.product_id = p.product_id 
                        WHERE c.cart_id = ?";
        $get_item_stmt = $conn->prepare($get_item_sql);
        $get_item_stmt->bind_param("i", $cart_id);
        $get_item_stmt->execute();
        $result = $get_item_stmt->get_result();
        $item = $result->fetch_assoc();
        
        if ($item) {
            $subtotal = $item['price'] * $item['quantity'];
            echo json_encode([
                'success' => true,
                'message' => 'Cart updated successfully',
                'quantity' => $item['quantity'],
                'subtotal' => $subtotal
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to fetch updated cart item'
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to update cart'
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error updating cart: ' . $e->getMessage()
    ]);
}

$conn->close();
?>
