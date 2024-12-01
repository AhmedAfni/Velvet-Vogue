<?php
if (!isset($_SESSION)) {
    session_start();
}

// Check if admin is logged in
if (!isset($_SESSION['admin_id']) && basename($_SERVER['PHP_SELF']) !== 'login.php') {
    header("Location: login.php?status=error&message=" . urlencode("Please login to access the admin panel."));
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon-32x32.png">
    <style>
        .navbar {
            padding: 1rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        .nav-link {
            padding: 0.5rem 1rem !important;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .nav-link:hover {
            background: rgba(255,255,255,0.1);
        }
        .nav-link.active {
            background: rgba(255,255,255,0.2);
        }
        .nav-link i {
            margin-right: 0.5rem;
        }
        .admin-info {
            border-left: 1px solid rgba(255,255,255,0.1);
            padding-left: 1rem;
            margin-left: 1rem;
        }
        .dropdown-menu {
            margin-top: 0.5rem;
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .dropdown-item i {
            margin-right: 0.5rem;
            width: 1rem;
            text-align: center;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="../assets/brand.png" alt="Velvet Vogue" height="30" class="d-inline-block align-text-top me-2">
            Velvet Vogue Admin
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'index.php' ? 'active' : ''; ?>" 
                       href="index.php">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'products.php' ? 'active' : ''; ?>" 
                       href="products.php">
                        <i class="bi bi-box"></i> Products
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'orders.php' ? 'active' : ''; ?>" 
                       href="orders.php">
                        <i class="bi bi-cart"></i> Orders
                    </a>
                </li>
            </ul>
            <?php if (isset($_SESSION['admin_id'])): ?>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" 
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
                            <?php echo htmlspecialchars($_SESSION['admin_name']); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminDropdown">
                            <li>
                                <a class="dropdown-item" href="admin.php">
                                    <i class="bi bi-gear"></i> Profile Settings
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="signout.php">
                                    <i class="bi bi-box-arrow-right"></i> Sign Out
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</nav>

<?php if (isset($_GET['message'])): ?>
    <div class="container mt-3">
        <div class="alert alert-<?php echo isset($_GET['status']) && $_GET['status'] === 'error' ? 'danger' : 'success'; ?> alert-dismissible fade show">
            <i class="bi bi-<?php echo isset($_GET['status']) && $_GET['status'] === 'error' ? 'exclamation-triangle' : 'check-circle'; ?>"></i>
            <?php echo htmlspecialchars($_GET['message']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
<?php endif; ?>
