<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>

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
    /* Updated Signup Link Color */
    .signup-link {
      color: #dc3545; /* Matching the login button color */
      font-weight: bold;
      text-decoration: none;
      transition: color 0.3s;
    }
    .signup-link:hover {
      color: #e0a800; /* Darker shade when hovered */
    }
  </style>
</head>
<body>

<div class="card text-center">
  <h2 class="card-title mb-3">Admin Login</h2> <br>
  
  <form method="POST" action="login.php">
    <!-- Email -->
    <div class="mb-3">
        <input type="email" class="form-control" id="adminEmail" name="adminEmail" placeholder="Enter your email" required>
    </div>

    <!-- Password -->
    <div class="mb-3">
        <input type="password" class="form-control" id="adminPassword" name="adminPassword" placeholder="Enter your password" required>
    </div>
    
    <!-- Login Button -->
    <button type="submit" class="btn btn-custom w-100">Login</button>
</form>

  
  <!-- Links -->
<div class="mt-4">
  <p>Don't have an account? <a href="register.php" class="signup-link">Sign Up</a></p>
  </div>
</div>

<?php
// Check if the message is set in the URL
if (isset($_GET['message'])) {
    echo "<script>alert('" . $_GET['message'] . "');</script>";
}
?>

</body>
</html>
