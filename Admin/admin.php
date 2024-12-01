<?php
require_once 'includes/config.php';
checkAdminAuth();

$success_message = '';
$error_message = '';

// Handle admin profile update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $admin_id = $_SESSION['admin_id']; // Only allow updating own profile
        $name = sanitizeInput($_POST['name']);
        $email = sanitizeInput($_POST['email']);
        
        switch ($_POST['action']) {
            case 'update_profile':
                if (!validateEmail($email)) {
                    $error_message = "Invalid email format";
                } else {
                    // Check if email is already taken by another admin
                    $check_sql = "SELECT id FROM admins WHERE email = ? AND id != ?";
                    $check_stmt = $conn->prepare($check_sql);
                    $check_stmt->bind_param("si", $email, $admin_id);
                    $check_stmt->execute();
                    $result = $check_stmt->get_result();
                    
                    if ($result->num_rows > 0) {
                        $error_message = "Email is already taken by another admin";
                    } else {
                        $sql = "UPDATE admins SET name = ?, email = ? WHERE id = ?";
                        $stmt = $conn->prepare($sql);
                        
                        if ($stmt) {
                            $stmt->bind_param("ssi", $name, $email, $admin_id);
                            if ($stmt->execute()) {
                                $_SESSION['admin_name'] = $name; // Update session
                                $success_message = "Profile updated successfully";
                            } else {
                                $error_message = "Error updating profile";
                                error_log("Error updating admin profile: " . $stmt->error);
                            }
                            $stmt->close();
                        }
                    }
                    $check_stmt->close();
                }
                break;
                
            case 'change_password':
                $current_password = $_POST['current_password'];
                $new_password = $_POST['new_password'];
                $confirm_password = $_POST['confirm_password'];
                
                if ($new_password !== $confirm_password) {
                    $error_message = "New passwords do not match";
                } else {
                    // Verify current password
                    $sql = "SELECT password FROM admins WHERE id = ?";
                    $stmt = $conn->prepare($sql);
                    if ($stmt) {
                        $stmt->bind_param("i", $admin_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if ($row = $result->fetch_assoc()) {
                            if (password_verify($current_password, $row['password'])) {
                                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                                
                                $update_sql = "UPDATE admins SET password = ? WHERE id = ?";
                                $update_stmt = $conn->prepare($update_sql);
                                
                                if ($update_stmt) {
                                    $update_stmt->bind_param("si", $hashed_password, $admin_id);
                                    if ($update_stmt->execute()) {
                                        $success_message = "Password updated successfully";
                                    } else {
                                        $error_message = "Error updating password";
                                        error_log("Error updating admin password: " . $update_stmt->error);
                                    }
                                    $update_stmt->close();
                                }
                            } else {
                                $error_message = "Current password is incorrect";
                            }
                        }
                        $stmt->close();
                    }
                }
                break;
        }
    }
}

// Get current admin data
$admin_id = $_SESSION['admin_id'];
$sql = "SELECT * FROM admins WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings - Velvet Vogue Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .card {
            border: none;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .card-header {
            background-color: #f8f9fa;
            border-bottom: none;
            padding: 1.5rem;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #0d6efd;
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <?php if ($success_message): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>
                        <?php echo $success_message; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
                
                <?php if ($error_message): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <?php echo $error_message; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <!-- Profile Information -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="mb-0"><i class="bi bi-person-circle me-2"></i>Profile Information</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" class="needs-validation" novalidate>
                            <input type="hidden" name="action" value="update_profile">
                            
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" 
                                       value="<?php echo htmlspecialchars($admin['name']); ?>" required>
                                <div class="invalid-feedback">Please enter your name</div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" 
                                       value="<?php echo htmlspecialchars($admin['email']); ?>" required>
                                <div class="invalid-feedback">Please enter a valid email</div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-lg me-2"></i>Update Profile
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Change Password -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0"><i class="bi bi-shield-lock me-2"></i>Change Password</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" class="needs-validation" novalidate>
                            <input type="hidden" name="action" value="change_password">
                            
                            <div class="mb-3">
                                <label class="form-label">Current Password</label>
                                <input type="password" class="form-control" name="current_password" required>
                                <div class="invalid-feedback">Please enter your current password</div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <input type="password" class="form-control" name="new_password" required>
                                <div class="invalid-feedback">Please enter a new password</div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" name="confirm_password" required>
                                <div class="invalid-feedback">Please confirm your new password</div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-key me-2"></i>Change Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Form validation
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()

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
