<?php
require_once 'includes/config.php';

// Redirect if already logged in
if (isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitizeInput($_POST['email']);
    $password = $_POST['password'];

    // Validate email
    if (!validateEmail($email)) {
        $error = "Invalid email format";
    } else {
        // Prepare and execute the SQL query
        $sql = "SELECT id, name, email, password FROM admins WHERE email = ?";
        $stmt = $conn->prepare($sql);
        
        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($row = $result->fetch_assoc()) {
                if (password_verify($password, $row['password'])) {
                    // Set session variables
                    $_SESSION['admin_id'] = $row['id'];
                    $_SESSION['admin_name'] = $row['name'];
                    $_SESSION['admin_email'] = $row['email'];
                    $_SESSION['last_activity'] = time();

                    // Log successful login
                    error_log("Admin login successful: " . $email);

                    header("Location: index.php");
                    exit();
                } else {
                    $error = "Invalid email or password";
                    error_log("Failed login attempt for admin: " . $email);
                }
            } else {
                $error = "Invalid email or password";
                error_log("Failed login attempt for non-existent admin: " . $email);
            }
            
            $stmt->close();
        } else {
            $error = "System error. Please try again later.";
            error_log("Login prepare statement failed: " . $conn->error);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Velvet Vogue</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon-32x32.png">
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Arial', sans-serif;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 15px;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .card-header {
            background: linear-gradient(45deg, #343a40, #495057);
            color: white;
            text-align: center;
            border-radius: 15px 15px 0 0 !important;
            padding: 20px;
        }
        .card-body {
            padding: 30px;
        }
        .btn-dark {
            width: 100%;
            padding: 12px;
            font-weight: bold;
            background: linear-gradient(45deg, #343a40, #495057);
            border: none;
            transition: all 0.3s ease;
        }
        .btn-dark:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            background: linear-gradient(45deg, #495057, #343a40);
        }
        .form-control {
            padding: 12px;
            border-radius: 10px;
            border: 1px solid #dee2e6;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #343a40;
            box-shadow: 0 0 0 0.2rem rgba(52, 58, 64, 0.25);
        }
        .brand-logo {
            width: 80px;
            height: 80px;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }
        .brand-logo:hover {
            transform: scale(1.1);
        }
        .alert {
            border-radius: 10px;
            border: none;
        }
        .back-to-site {
            color: #6c757d;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        .back-to-site:hover {
            color: #343a40;
            transform: translateX(-5px);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="card">
            <div class="card-header">
                <img src="../assets/brand.png" alt="Velvet Vogue Logo" class="brand-logo">
                <h4 class="mb-0">Admin Login</h4>
            </div>
            <div class="card-body">
                <?php if ($error): ?>
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>
                
                <?php if (isset($_GET['message'])): ?>
                    <div class="alert alert-<?php echo isset($_GET['status']) && $_GET['status'] === 'error' ? 'danger' : 'success'; ?>">
                        <i class="bi bi-<?php echo isset($_GET['status']) && $_GET['status'] === 'error' ? 'exclamation-triangle-fill' : 'check-circle-fill'; ?> me-2"></i>
                        <?php echo htmlspecialchars($_GET['message']); ?>
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="" autocomplete="off">
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="bi bi-envelope me-2"></i>Email Address
                        </label>
                        <input type="email" class="form-control" name="email" required 
                               placeholder="Enter your email"
                               value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="bi bi-lock me-2"></i>Password
                        </label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" required
                                   id="password" placeholder="Enter your password">
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark mb-3">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Login
                    </button>
                </form>
            </div>
        </div>
        <div class="text-center mt-3">
            <a href="../" class="back-to-site">
                <i class="bi bi-arrow-left"></i>
                Back to Website
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        
        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.querySelector('i').classList.toggle('bi-eye');
            this.querySelector('i').classList.toggle('bi-eye-slash');
        });

        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const alerts = document.getElementsByClassName('alert');
                for (let alert of alerts) {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }
            }, 5000);
        });
    </script>
</body>
</html>
