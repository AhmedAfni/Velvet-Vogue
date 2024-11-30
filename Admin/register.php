<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Signup</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <style>
    body {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa; /* Optional light background */
    }
    .card {
      background-color: #fff;
      border: none;
      border-radius: 15px;
      padding: 40px;
      width: 100%;
      max-width: 500px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }
    .card-title {
      font-size: 1.8rem;
      font-weight: bold;
      color: #ffc107;
    }
    .card-text {
      color: #6c757d;
      margin-bottom: 1.5rem;
    }
    .form-control {
      background-color: #f9f9f9;
      border: 1px solid #ffc107;
      border-radius: 10px;
      padding: 10px 15px;
      font-size: 1rem;
    }
    .form-control:focus {
      border-color: #dc3545;
      box-shadow: 0 0 10px rgba(220, 53, 69, 0.2);
    }
    .btn-custom {
      background-color: #ffc107;
      color: #fff;
      font-weight: bold;
      padding: 10px 20px;
      font-size: 1rem;
      border: none;
      border-radius: 10px;
      transition: all 0.3s;
    }
    .btn-custom:hover {
      background-color: #e0a800;
      transform: scale(1.05);
    }
    .login-link {
      color: #dc3545;
      font-weight: bold;
      text-decoration: none;
      transition: color 0.3s;
    }
    .login-link:hover {
      color: #b02a37;
    }
  </style>
</head>
<body>

<div class="card text-center">
  <h2 class="card-title mb-3">Admin Signup</h2>
  <p class="card-text">Create your admin account to get started.</p>
  
  <form method="POST" action="signup.php">
    <!-- Name -->
    <div class="mb-3">
        <input type="text" class="form-control" id="adminName" name="adminName" placeholder="Enter your full name" required>
    </div>

    <!-- Email -->
    <div class="mb-3">
        <input type="email" class="form-control" id="adminEmail" name="adminEmail" placeholder="Enter your email" required>
    </div>

    <!-- Password -->
    <div class="mb-3">
        <input type="password" class="form-control" id="adminPassword" name="adminPassword" placeholder="Enter your password" required>
    </div>

    <!-- Confirm Password -->
    <div class="mb-3">
        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password" required>
    </div>

    <!-- Signup Button -->
    <button type="submit" class="btn btn-custom w-100">Sign Up</button>
</form>


  
  <!-- Links -->
  <div class="mt-4">
    <p>Already have an account? <a href="index.php" class="login-link">Login</a></p>
  </div>
</div>

</body>
</html>
