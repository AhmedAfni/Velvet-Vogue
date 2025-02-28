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

// Get product type distribution
$sql = "SELECT product_type, COUNT(*) as count FROM products GROUP BY product_type";
$product_types = $conn->query($sql);

// Get recent users
$sql = "SELECT * FROM users ORDER BY created_at DESC LIMIT 5";
$recent_users = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Velvet Vogue</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon-32x32.png">

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
            position: relative;
            z-index: 1;
        }

        .stats-card::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 150px;
            height: 100%;
            background: linear-gradient(135deg, transparent, rgba(255,255,255,0.1));
            z-index: -1;
        }

        .stats-icon {
            font-size: 2rem;
            opacity: 0.9;
            margin-bottom: 0.5rem;
        }

        .card-subtitle {
            font-size: 0.8rem;
            margin-bottom: 0.5rem;
        }

        .card-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
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
            <div class="col-md-6">
                <div class="card stats-card bg-primary h-100">
                    <div class="card-body py-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-1 text-white">Total Products</h6>
                                <h2 class="card-title mb-0 text-white"><?php echo $total_products; ?></h2>
                            </div>
                            <div class="stats-icon">
                                <i class="bi bi-box text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card stats-card bg-primary h-100">
                    <div class="card-body py-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-1 text-white">Total Users</h6>
                                <h2 class="card-title mb-0 text-white"><?php echo $total_users; ?></h2>
                            </div>
                            <div class="stats-icon">
                                <i class="bi bi-people text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card stats-card bg-warning h-100">
                    <div class="card-body py-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-1 text-dark">Total Inquiries</h6>
                                <h2 class="card-title text-dark">15</h2>
                            </div>
                            <div class="stats-icon text-dark">
                                <i class="bi bi-chat-dots"></i>
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
                    <div class="card-header bg-warning">
                        <h5 class="mb-0 text-dark">
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
                    <div class="card-header bg-warning">
                        <h5 class="mb-0 text-dark">
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($user = $recent_users->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo $user['full_name']; ?></td>
                                        <td><?php echo $user['email']; ?></td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Recent Inquiries</h5>
                        <a href="#" class="btn btn-sm btn-primary">View All</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Subject</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>John Doe</td>
                                        <td>Product Availability</td>
                                        <td><span class="badge bg-warning">Pending</span></td>
                                        <td>Feb 28, 2025</td>
                                    </tr>
                                    <tr>
                                        <td>Jane Smith</td>
                                        <td>Shipping Question</td>
                                        <td><span class="badge bg-success">Resolved</span></td>
                                        <td>Feb 27, 2025</td>
                                    </tr>
                                    <tr>
                                        <td>Mike Johnson</td>
                                        <td>Size Guide</td>
                                        <td><span class="badge bg-warning">Pending</span></td>
                                        <td>Feb 27, 2025</td>
                                    </tr>
                                    <tr>
                                        <td>Sarah Williams</td>
                                        <td>Return Policy</td>
                                        <td><span class="badge bg-success">Resolved</span></td>
                                        <td>Feb 26, 2025</td>
                                    </tr>
                                    <tr>
                                        <td>David Brown</td>
                                        <td>Payment Issue</td>
                                        <td><span class="badge bg-warning">Pending</span></td>
                                        <td>Feb 26, 2025</td>
                                    </tr>
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
