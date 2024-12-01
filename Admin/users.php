<?php
require_once 'includes/config.php';
checkAdminAuth();

// Handle user operations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $user_id = sanitizeInput($_POST['user_id']);
        
        switch ($_POST['action']) {
            case 'update_status':
                $status = sanitizeInput($_POST['status']);
                
                $sql = "UPDATE users SET status = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("si", $status, $user_id);
                
                if ($stmt->execute()) {
                    $_SESSION['success'] = "User status updated successfully";
                } else {
                    $_SESSION['error'] = "Error updating user status";
                    error_log("Error updating user status: " . $stmt->error);
                }
                $stmt->close();
                break;
                
            case 'delete':
                // First check if user has any orders
                $check_sql = "SELECT COUNT(*) as count FROM orders WHERE user_id = ?";
                $check_stmt = $conn->prepare($check_sql);
                $check_stmt->bind_param("i", $user_id);
                $check_stmt->execute();
                $result = $check_stmt->get_result();
                $row = $result->fetch_assoc();
                
                if ($row['count'] > 0) {
                    $_SESSION['error'] = "Cannot delete user with existing orders";
                } else {
                    $sql = "DELETE FROM users WHERE id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $user_id);
                    
                    if ($stmt->execute()) {
                        $_SESSION['success'] = "User deleted successfully";
                    } else {
                        $_SESSION['error'] = "Error deleting user";
                        error_log("Error deleting user: " . $stmt->error);
                    }
                    $stmt->close();
                }
                $check_stmt->close();
                break;
        }
    }
    // Redirect to prevent form resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Get filter parameters
$status_filter = isset($_GET['status']) ? sanitizeInput($_GET['status']) : '';
$search = isset($_GET['search']) ? sanitizeInput($_GET['search']) : '';

// Build the SQL query with filters
$sql = "SELECT u.*, COUNT(o.id) as order_count 
        FROM users u 
        LEFT JOIN orders o ON u.id = o.user_id";

$where_conditions = [];
$params = [];
$param_types = "";

if ($status_filter) {
    $where_conditions[] = "u.status = ?";
    $params[] = $status_filter;
    $param_types .= "s";
}

if ($search) {
    $search_term = "%$search%";
    $where_conditions[] = "(u.name LIKE ? OR u.email LIKE ?)";
    $params[] = $search_term;
    $params[] = $search_term;
    $param_types .= "ss";
}

if (!empty($where_conditions)) {
    $sql .= " WHERE " . implode(" AND ", $where_conditions);
}

$sql .= " GROUP BY u.id ORDER BY u.created_at DESC";

$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($param_types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>User Management</h2>
            
            <!-- Filter and Search Form -->
            <form class="d-flex gap-2" method="GET">
                <select name="status" class="form-select" style="width: auto;" onchange="this.form.submit()">
                    <option value="">All Status</option>
                    <option value="active" <?php echo $status_filter === 'active' ? 'selected' : ''; ?>>Active</option>
                    <option value="inactive" <?php echo $status_filter === 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                </select>
                <div class="input-group" style="width: auto;">
                    <input type="text" name="search" class="form-control" placeholder="Search users..." 
                           value="<?php echo htmlspecialchars($search); ?>">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>
        
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php 
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php 
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        
        <div class="table-responsive mt-4">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Orders</th>
                        <th>Joined Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td>
                            <span class="badge bg-<?php echo $row['status'] === 'active' ? 'success' : 'danger'; ?>">
                                <?php echo ucfirst($row['status']); ?>
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-info">
                                <?php echo $row['order_count']; ?> orders
                            </span>
                        </td>
                        <td><?php echo date('M d, Y', strtotime($row['created_at'])); ?></td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-warning update-status-btn" 
                                        data-id="<?php echo $row['id']; ?>"
                                        data-status="<?php echo $row['status']; ?>"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#updateStatusModal"
                                        title="Update Status">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-danger delete-btn"
                                        data-id="<?php echo $row['id']; ?>"
                                        onclick="deleteUser(<?php echo $row['id']; ?>)"
                                        <?php echo $row['order_count'] > 0 ? 'disabled' : ''; ?>
                                        title="<?php echo $row['order_count'] > 0 ? 'Cannot delete user with orders' : 'Delete User'; ?>">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Update Status Modal -->
    <div class="modal fade" id="updateStatusModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update User Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="update_status">
                        <input type="hidden" name="user_id" id="update_user_id">
                        
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" id="update_status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Form -->
    <form id="deleteForm" method="POST" style="display: none;">
        <input type="hidden" name="action" value="delete">
        <input type="hidden" name="user_id" id="delete_user_id">
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Handle status update modal
        document.querySelectorAll('.update-status-btn').forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById('update_user_id').value = this.dataset.id;
                document.getElementById('update_status').value = this.dataset.status;
            });
        });

        // Handle user deletion
        function deleteUser(userId) {
            if (confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
                document.getElementById('delete_user_id').value = userId;
                document.getElementById('deleteForm').submit();
            }
        }

        // Auto-hide alerts after 5 seconds
        document.querySelectorAll('.alert').forEach(alert => {
            setTimeout(() => {
                const closeButton = alert.querySelector('.btn-close');
                if (closeButton) {
                    closeButton.click();
                }
            }, 5000);
        });
    </script>
</body>
</html>
