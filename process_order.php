<?php
session_start();
error_reporting(E_ERROR | E_PARSE); // Only show fatal errors
header('Content-Type: application/json');

// Function to send JSON response and exit
function sendJsonResponse($success, $message, $data = []) {
    echo json_encode(array_merge(
        ['success' => $success, 'message' => $message],
        $data
    ));
    exit;
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    sendJsonResponse(false, 'Please log in to complete your order');
}

include 'config.php';

// Get POST data
$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (!$data) {
    sendJsonResponse(false, 'Invalid request data');
}

// Validate payment data
function validateCard($number) {
    // Remove any non-digit characters
    $number = preg_replace('/\D/', '', $number);
    
    // Check length (16-19 digits)
    return strlen($number) >= 16 && strlen($number) <= 19;
}

function validateExpiryDate($expiry) {
    if (!preg_match('/^\d{2}\/\d{2}$/', $expiry)) {
        return false;
    }
    
    list($month, $year) = explode('/', $expiry);
    $month = (int)$month;
    $year = (int)('20' . $year);
    
    if ($month < 1 || $month > 12) {
        return false;
    }
    
    $currentYear = (int)date('Y');
    $currentMonth = (int)date('m');
    
    if ($year < $currentYear || 
        ($year == $currentYear && $month < $currentMonth)) {
        return false;
    }
    
    return true;
}

// Validate all payment fields
if (!isset($data['cardNumber']) || !validateCard($data['cardNumber'])) {
    sendJsonResponse(false, 'Invalid card number');
}

if (!isset($data['expiryDate']) || !validateExpiryDate($data['expiryDate'])) {
    sendJsonResponse(false, 'Invalid expiry date');
}

if (!isset($data['cvv']) || !preg_match('/^\d{3}$/', $data['cvv'])) {
    sendJsonResponse(false, 'Invalid CVV');
}

if (!isset($data['cardName']) || !preg_match('/^[a-zA-Z\s]{3,}$/', $data['cardName'])) {
    sendJsonResponse(false, 'Invalid cardholder name');
}

try {
    // Start transaction
    $conn->begin_transaction();

    // Generate unique order number
    $order_number = 'ORD' . date('YmdHis') . rand(100, 999);
    
    // Get cart items
    $cart_sql = "SELECT c.*, p.price, p.product_name 
                 FROM cart c 
                 JOIN products p ON c.product_id = p.product_id 
                 WHERE c.user_id = ?";
    $cart_stmt = $conn->prepare($cart_sql);
    $cart_stmt->bind_param("i", $_SESSION['user_id']);
    $cart_stmt->execute();
    $cart_result = $cart_stmt->get_result();
    
    // Calculate total amount
    $total_amount = 0;
    $cart_items = [];
    while ($item = $cart_result->fetch_assoc()) {
        // Verify the price calculation
        $price = floatval($item['price']);
        $quantity = intval($item['quantity']);
        $subtotal = $price * $quantity;
        
        if ($subtotal <= 0) {
            throw new Exception('Invalid price calculation for ' . $item['product_name']);
        }
        
        $total_amount += $subtotal;
        $item['subtotal'] = $subtotal; // Add subtotal to item for order details
        $cart_items[] = $item;
    }
    
    if (empty($cart_items)) {
        throw new Exception('Your cart is empty');
    }
    
    // Add shipping cost
    $shipping_cost = 350.00;
    $total_amount += $shipping_cost;
    
    // Get user details
    $user_sql = "SELECT home_address, email FROM users WHERE id = ?";
    $user_stmt = $conn->prepare($user_sql);
    $user_stmt->bind_param("i", $_SESSION['user_id']);
    $user_stmt->execute();
    $user_result = $user_stmt->get_result();
    $user_data = $user_result->fetch_assoc();
    
    if (!$user_data) {
        throw new Exception('User details not found');
    }
    
    $shipping_address = $user_data['home_address'];
    
    // Create order first
    $order_sql = "INSERT INTO orders (order_number, user_id, total_amount, status, payment_status, 
                                    shipping_address, billing_address, shipping_method, shipping_cost, 
                                    payment_method, tax_amount, created_at) 
                 VALUES (?, ?, ?, 'processing', 'pending', ?, ?, 'Standard Delivery', ?, 'Credit Card', 0.00, NOW())";
    
    $order_stmt = $conn->prepare($order_sql);
    $order_stmt->bind_param("sidssd", 
        $order_number,
        $_SESSION['user_id'],
        $total_amount,
        $shipping_address,
        $shipping_address, // Using same address for billing
        $shipping_cost
    );
    $order_stmt->execute();
    $order_id = $conn->insert_id;
    
    if (!$order_id) {
        throw new Exception('Failed to create order');
    }
    
    // Insert order items
    $items_sql = "INSERT INTO order_items (order_id, product_id, quantity, size, price, subtotal) 
                  VALUES (?, ?, ?, ?, ?, ?)";
    $items_stmt = $conn->prepare($items_sql);
    
    foreach ($cart_items as $item) {
        $items_stmt->bind_param("iiisdd",
            $order_id,
            $item['product_id'],
            $item['quantity'],
            $item['size'],
            $item['price'],
            $item['subtotal']
        );
        $items_stmt->execute();
    }
    
    // Create payment record
    $payment_sql = "INSERT INTO payments (order_number, amount, payment_method, card_last_four, 
                                        cardholder_name, status, created_at) 
                   VALUES (?, ?, 'Credit Card', ?, ?, 'completed', NOW())";
    $payment_stmt = $conn->prepare($payment_sql);
    $card_last_four = substr(preg_replace('/\D/', '', $data['cardNumber']), -4);
    $payment_stmt->bind_param("sdss", 
        $order_number,
        $total_amount,
        $card_last_four,
        $data['cardName']
    );
    
    if (!$payment_stmt->execute()) {
        throw new Exception('Failed to process payment');
    }
    
    // Update order payment status
    $update_order_sql = "UPDATE orders SET payment_status = 'paid' WHERE order_id = ?";
    $update_order_stmt = $conn->prepare($update_order_sql);
    $update_order_stmt->bind_param("i", $order_id);
    $update_order_stmt->execute();
    
    // Clear the user's cart
    $clear_cart_sql = "DELETE FROM cart WHERE user_id = ?";
    $clear_cart_stmt = $conn->prepare($clear_cart_sql);
    $clear_cart_stmt->bind_param("i", $_SESSION['user_id']);
    $clear_cart_stmt->execute();
    
    // Send order confirmation email
    try {
        $to = $user_data['email'];
        $subject = "Order Confirmation - $order_number";
        
        $message = "Thank you for your order!\n\n";
        $message .= "Order Number: $order_number\n";
        $message .= "Order Total: LKR " . number_format($total_amount, 2) . "\n\n";
        $message .= "Order Details:\n";
        foreach ($cart_items as $item) {
            $message .= "{$item['product_name']} - {$item['size']} - Quantity: {$item['quantity']} - LKR " . 
                       number_format($item['subtotal'], 2) . "\n";
        }
        $message .= "\nShipping Cost: LKR " . number_format($shipping_cost, 2) . "\n";
        $message .= "Shipping Address: $shipping_address\n\n";
        $message .= "Thank you for shopping with Velvet Vogue!";
        
        $headers = "From: noreply@velvetvogue.com";
        
        mail($to, $subject, $message, $headers);
    } catch (Exception $e) {
        // Log email error but don't stop the transaction
        error_log("Failed to send order confirmation email: " . $e->getMessage());
    }
    
    // Commit transaction
    $conn->commit();
    
    // Return success response
    sendJsonResponse(true, 'Order placed successfully!', ['order_number' => $order_number]);
    
} catch (Exception $e) {
    // Rollback transaction on error
    $conn->rollback();
    sendJsonResponse(false, 'Error processing order: ' . $e->getMessage());
}

$conn->close();
?>
