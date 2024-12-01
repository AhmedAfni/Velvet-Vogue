<?php
require_once 'includes/config.php';
checkAdminAuth();

if (!isset($_GET['id'])) {
    die('Order ID not provided');
}

$order_id = $_GET['id'];

// Get order details
$sql = "SELECT o.*, u.email, u.full_name 
        FROM orders o
        JOIN users u ON o.user_id = u.id
        WHERE o.order_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();

if (!$order) {
    die('Order not found');
}

// Get order items
$sql = "SELECT oi.*, p.product_name, p.image_path
        FROM order_items oi
        JOIN products p ON oi.product_id = p.product_id
        WHERE oi.order_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$items = $stmt->get_result();
?>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body">
                <h6 class="card-title mb-3">Order Information</h6>
                <table class="table table-sm">
                    <tr>
                        <th>Order Number:</th>
                        <td><?php echo htmlspecialchars($order['order_number']); ?></td>
                    </tr>
                    <tr>
                        <th>Date:</th>
                        <td><?php echo date('M d, Y H:i', strtotime($order['created_at'])); ?></td>
                    </tr>
                    <tr>
                        <th>Status:</th>
                        <td>
                            <span class="badge status-badge bg-<?php 
                                echo match($order['status']) {
                                    'pending' => 'warning',
                                    'processing' => 'info',
                                    'shipped' => 'primary',
                                    'delivered' => 'success',
                                    'cancelled' => 'danger',
                                    default => 'secondary'
                                };
                            ?>">
                                <?php echo ucfirst($order['status']); ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Payment Status:</th>
                        <td>
                            <span class="badge status-badge bg-<?php 
                                echo match($order['payment_status']) {
                                    'pending' => 'warning',
                                    'paid' => 'success',
                                    'failed' => 'danger',
                                    'refunded' => 'info',
                                    default => 'secondary'
                                };
                            ?>">
                                <?php echo ucfirst($order['payment_status']); ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Payment Method:</th>
                        <td><?php echo htmlspecialchars($order['payment_method']); ?></td>
                    </tr>
                    <tr>
                        <th>Shipping Method:</th>
                        <td><?php echo htmlspecialchars($order['shipping_method']); ?></td>
                    </tr>
                    <tr>
                        <th>Shipping Cost:</th>
                        <td>LKR <?php echo number_format($order['shipping_cost'], 2); ?></td>
                    </tr>
                    <tr>
                        <th>Total Amount:</th>
                        <td class="order-total">LKR <?php echo number_format($order['total_amount'], 2); ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body">
                <h6 class="card-title mb-3">Customer Information</h6>
                <table class="table table-sm">
                    <tr>
                        <th>Name:</th>
                        <td><?php echo htmlspecialchars($order['full_name']); ?></td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td><?php echo htmlspecialchars($order['email']); ?></td>
                    </tr>
                    <tr>
                        <th>Shipping Address:</th>
                        <td><?php echo nl2br(htmlspecialchars($order['shipping_address'])); ?></td>
                    </tr>
                    <tr>
                        <th>Billing Address:</th>
                        <td><?php echo nl2br(htmlspecialchars($order['billing_address'])); ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-body">
        <h6 class="card-title mb-3">Order Items</h6>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Image</th>
                        <th>Size</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($item = $items->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                        <td>
                            <img src="../<?php echo htmlspecialchars($item['image_path']); ?>" 
                                 alt="<?php echo htmlspecialchars($item['product_name']); ?>"
                                 class="img-thumbnail"
                                 style="width: 50px; height: 50px; object-fit: cover;">
                        </td>
                        <td><?php echo htmlspecialchars($item['size']); ?></td>
                        <td>LKR <?php echo number_format($item['price'], 2); ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td>LKR <?php echo number_format($item['subtotal'], 2); ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
