<?php
require_once 'includes/config.php';
checkAdminAuth();

// Handle order status updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_status') {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];
    
    $sql = "UPDATE orders SET status = ? WHERE order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $order_id);
    $stmt->execute();
}

// Fetch all orders with customer details
$sql = "SELECT o.*, u.email as customer_email, u.full_name as customer_name 
        FROM orders o 
        LEFT JOIN users u ON o.user_id = u.id 
        ORDER BY o.created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .status-badge {
            font-size: 0.9em;
            padding: 0.5em 0.8em;
        }
        .table th {
            background-color: #f8f9fa;
        }
        .order-total {
            font-weight: bold;
            color: #198754;
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="container mt-4">
        <h2 class="mb-4">Order Management</h2>
        
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Order Number</th>
                        <th>Customer</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Payment Status</th>
                        <th>Order Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['order_number']); ?></td>
                        <td>
                            <?php echo htmlspecialchars($row['customer_name']); ?><br>
                            <small class="text-muted"><?php echo htmlspecialchars($row['customer_email']); ?></small>
                        </td>
                        <td class="order-total">LKR <?php echo number_format($row['total_amount'], 2); ?></td>
                        <td>
                            <span class="badge status-badge bg-<?php 
                                echo match($row['status']) {
                                    'pending' => 'warning',
                                    'processing' => 'info',
                                    'shipped' => 'primary',
                                    'delivered' => 'success',
                                    'cancelled' => 'danger',
                                    default => 'secondary'
                                };
                            ?>">
                                <?php echo ucfirst($row['status']); ?>
                            </span>
                        </td>
                        <td>
                            <span class="badge status-badge bg-<?php 
                                echo match($row['payment_status']) {
                                    'pending' => 'warning',
                                    'paid' => 'success',
                                    'failed' => 'danger',
                                    'refunded' => 'info',
                                    default => 'secondary'
                                };
                            ?>">
                                <?php echo ucfirst($row['payment_status']); ?>
                            </span>
                        </td>
                        <td><?php echo date('M d, Y H:i', strtotime($row['created_at'])); ?></td>
                        <td>
                            <button class="btn btn-sm btn-primary view-order-btn" 
                                    data-id="<?php echo $row['order_id']; ?>"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#orderDetailsModal">
                                <i class="bi bi-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-warning update-status-btn"
                                    data-id="<?php echo $row['order_id']; ?>"
                                    data-status="<?php echo $row['status']; ?>"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#updateStatusModal">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Order Details Modal -->
    <div class="modal fade" id="orderDetailsModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Order Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="orderDetails">
                        Loading...
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Status Modal -->
    <div class="modal fade" id="updateStatusModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Order Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="update_status">
                        <input type="hidden" name="order_id" id="update-order-id">
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status" id="update-status" required>
                                <option value="pending">Pending</option>
                                <option value="processing">Processing</option>
                                <option value="shipped">Shipped</option>
                                <option value="delivered">Delivered</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">Update Status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // View order details
        document.querySelectorAll('.view-order-btn').forEach(button => {
            button.addEventListener('click', () => {
                const orderId = button.dataset.id;
                const detailsDiv = document.getElementById('orderDetails');
                
                // Fetch order details using AJAX
                fetch(`get_order_details.php?id=${orderId}`)
                    .then(response => response.text())
                    .then(html => {
                        detailsDiv.innerHTML = html;
                    })
                    .catch(error => {
                        detailsDiv.innerHTML = 'Error loading order details.';
                    });
            });
        });

        // Update status
        document.querySelectorAll('.update-status-btn').forEach(button => {
            button.addEventListener('click', () => {
                document.getElementById('update-order-id').value = button.dataset.id;
                document.getElementById('update-status').value = button.dataset.status;
            });
        });
    </script>
</body>
</html>
