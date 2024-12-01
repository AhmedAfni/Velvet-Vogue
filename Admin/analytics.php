<?php
require_once 'includes/config.php';
checkAdminAuth();

// Get total revenue
$sql = "SELECT SUM(total_amount) as total_revenue FROM orders WHERE status != 'cancelled'";
$result = $conn->query($sql);
$revenue = $result->fetch_assoc()['total_revenue'] ?? 0;

// Get total orders
$sql = "SELECT COUNT(*) as total_orders FROM orders";
$result = $conn->query($sql);
$total_orders = $result->fetch_assoc()['total_orders'];

// Get total users
$sql = "SELECT COUNT(*) as total_users FROM users";
$result = $conn->query($sql);
$total_users = $result->fetch_assoc()['total_users'];

// Get sales by category
$sql = "SELECT p.category, COUNT(*) as count, SUM(oi.quantity * oi.price) as revenue
        FROM order_items oi
        JOIN products p ON oi.product_id = p.id
        JOIN orders o ON oi.order_id = o.id
        WHERE o.status != 'cancelled'
        GROUP BY p.category";
$category_sales = $conn->query($sql);

// Get recent orders
$sql = "SELECT o.*, u.email 
        FROM orders o
        JOIN users u ON o.user_id = u.id
        ORDER BY o.order_date DESC
        LIMIT 5";
$recent_orders = $conn->query($sql);

// Get monthly revenue for the past 12 months
$sql = "SELECT DATE_FORMAT(order_date, '%Y-%m') as month,
               SUM(total_amount) as revenue
        FROM orders
        WHERE status != 'cancelled'
        AND order_date >= DATE_SUB(NOW(), INTERVAL 12 MONTH)
        GROUP BY month
        ORDER BY month DESC";
$monthly_revenue = $conn->query($sql);

$revenue_data = [];
$revenue_labels = [];
while ($row = $monthly_revenue->fetch_assoc()) {
    $revenue_data[] = $row['revenue'];
    $revenue_labels[] = date('M Y', strtotime($row['month'] . '-01'));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics Dashboard - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="container mt-4">
        <h2>Analytics Dashboard</h2>

        <!-- Summary Cards -->
        <div class="row mt-4">
            <div class="col-md-4 mb-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Total Revenue</h5>
                        <h2 class="card-text">$<?php echo number_format($revenue, 2); ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Total Orders</h5>
                        <h2 class="card-text"><?php echo $total_orders; ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">Total Users</h5>
                        <h2 class="card-text"><?php echo $total_users; ?></h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="row mt-4">
            <div class="col-md-8 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Monthly Revenue</h5>
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Sales by Category</h5>
                        <canvas id="categoryChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Recent Orders</h5>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($order = $recent_orders->fetch_assoc()): ?>
                            <tr>
                                <td>#<?php echo $order['id']; ?></td>
                                <td><?php echo $order['email']; ?></td>
                                <td>$<?php echo number_format($order['total_amount'], 2); ?></td>
                                <td>
                                    <span class="badge bg-<?php 
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
                                <td><?php echo date('M d, Y H:i', strtotime($order['order_date'])); ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Monthly Revenue Chart
        new Chart(document.getElementById('revenueChart'), {
            type: 'line',
            data: {
                labels: <?php echo json_encode(array_reverse($revenue_labels)); ?>,
                datasets: [{
                    label: 'Monthly Revenue',
                    data: <?php echo json_encode(array_reverse($revenue_data)); ?>,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '$' + value;
                            }
                        }
                    }
                }
            }
        });

        // Category Sales Chart
        new Chart(document.getElementById('categoryChart'), {
            type: 'doughnut',
            data: {
                labels: [
                    <?php 
                    while($category = $category_sales->fetch_assoc()) {
                        echo "'" . ucfirst($category['category']) . "',";
                    }
                    ?>
                ],
                datasets: [{
                    data: [
                        <?php 
                        $category_sales->data_seek(0);
                        while($category = $category_sales->fetch_assoc()) {
                            echo $category['revenue'] . ",";
                        }
                        ?>
                    ],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
</body>
</html>
