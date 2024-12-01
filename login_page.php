<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Velvet Vogue</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .logo {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            font-size: 24px;
            font-weight: bold;
        }
        .form-control:focus {
            border-color: #ffc107;
            box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
        }
        .btn-warning {
            width: 100%;
            padding: 10px;
            font-weight: 500;
        }
        .register-link {
            text-align: center;
            margin-top: 20px;
        }
        .alert {
            display: none;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="logo">
                VELVET VOGUE
            </div>
            <form id="loginForm">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-warning">Login</button>
                <div class="alert alert-danger mt-3" id="errorAlert" role="alert"></div>
                <div class="alert alert-success mt-3" id="successAlert" role="alert"></div>
            </form>
            <div class="register-link">
                Don't have an account? <a href="register_page.php" class="text-warning">Register here</a>
            </div>
            <div class="text-center mt-3">
                <a href="home.php" class="text-muted">Back to Home</a>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault();
            
            const errorAlert = document.getElementById('errorAlert');
            const successAlert = document.getElementById('successAlert');
            
            fetch('login.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    email: document.getElementById('email').value,
                    password: document.getElementById('password').value
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    successAlert.style.display = 'block';
                    errorAlert.style.display = 'none';
                    successAlert.textContent = data.message;
                    window.location.href = 'home.php';
                } else {
                    errorAlert.style.display = 'block';
                    successAlert.style.display = 'none';
                    errorAlert.textContent = data.message;
                }
            })
            .catch(error => {
                errorAlert.style.display = 'block';
                successAlert.style.display = 'none';
                errorAlert.textContent = 'An error occurred. Please try again.';
            });
        });
    </script>
</body>
</html>
