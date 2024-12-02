<?php
require_once 'includes/config.php';
checkAdminAuth();

// Get total products
$sql = "SELECT COUNT(*) as total FROM products";
$result = $conn->query($sql);
$total_products = $result->fetch_assoc()['total'];

// Get total users
$sql = "SELECT COUNT(*) as total FROM users";
$result = $conn->query($sql);
$total_users = $result->fetch_assoc()['total'];

// Get total items in cart
$sql = "SELECT COUNT(*) as total FROM cart";
$result = $conn->query($sql);
$total_cart_items = $result->fetch_assoc()['total'];

// Get product type distribution
$sql = "SELECT product_type, COUNT(*) as count FROM products GROUP BY product_type";
$product_types = $conn->query($sql);

// Get recent users
$sql = "SELECT * FROM users ORDER BY created_at DESC LIMIT 5";
$recent_users = $conn->query($sql);

// Get recent cart activities
$sql = "SELECT c.*, p.product_name, u.full_name 
        FROM cart c 
        JOIN products p ON c.product_id = p.product_id 
        JOIN users u ON c.user_id = u.id 
        ORDER BY c.date_added DESC LIMIT 5";
$recent_cart = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Velvet Vogue</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .stats-card {
            background: linear-gradient(45deg, #343a40, #495057);
            color: white;
        }
        .stats-icon {
            font-size: 2.5rem;
            opacity: 0.8;
        }
        .recent-activity {
            max-height: 400px;
            overflow-y: auto;
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Welcome, <?php echo $_SESSION['admin_name']; ?>!</h2>
        </div>

        <!-- Statistics Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="card stats-card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-2">Total Products</h6>
                                <h2 class="card-title mb-0"><?php echo $total_products; ?></h2>
                            </div>
                            <div class="stats-icon">
                                <i class="bi bi-box"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stats-card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-2">Total Users</h6>
                                <h2 class="card-title mb-0"><?php echo $total_users; ?></h2>
                            </div>
                            <div class="stats-icon">
                                <i class="bi bi-people"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stats-card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-2">Items in Cart</h6>
                                <h2 class="card-title mb-0"><?php echo $total_cart_items; ?></h2>
                            </div>
                            <div class="stats-icon">
                                <i class="bi bi-cart"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Product Distribution -->
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">
                            <i class="bi bi-pie-chart"></i> Product Distribution
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product Type</th>
                                        <th>Count</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($type = $product_types->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo ucfirst($type['product_type']); ?></td>
                                        <td><?php echo $type['count']; ?></td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Users -->
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">
                            <i class="bi bi-person-plus"></i> Recent Users
                        </h5>
                    </div>
                    <div class="card-body recent-activity">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Joined</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($user = $recent_users->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo $user['full_name']; ?></td>
                                        <td><?php echo $user['email']; ?></td>
                                        <td><?php echo date('M d, Y', strtotime($user['created_at'])); ?></td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Cart Activity -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">
                            <i class="bi bi-cart-check"></i> Recent Cart Activity
                        </h5>
                    </div>
                    <div class="card-body recent-activity">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Product</th>
                                        <th>Size</th>
                                        <th>Quantity</th>
                                        <th>Date Added</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($cart = $recent_cart->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo $cart['full_name']; ?></td>
                                        <td><?php echo $cart['product_name']; ?></td>
                                        <td><?php echo $cart['size']; ?></td>
                                        <td><?php echo $cart['quantity']; ?></td>
                                        <td><?php echo date('M d, Y H:i', strtotime($cart['date_added'])); ?></td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
