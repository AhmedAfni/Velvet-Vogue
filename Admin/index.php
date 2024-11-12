<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
  <!-- Custom CSS (optional) -->
  <style>
    body {
      font-family: 'Arial', sans-serif;
    }
    .sidebar {
      height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      background-color: #343a40;
      color: white;
      width: 250px;
      padding-top: 20px;
    }
    .sidebar .nav-link {
      color: white;
    }
    .sidebar .nav-link:hover {
      background-color: #007bff;
    }
    .main-content {
      margin-left: 250px;
      padding: 20px;
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <h2 class="text-center text-white">Admin Panel</h2>
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link active" href="#">
          Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          Products
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          Orders
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          Settings
        </a>
      </li>
    </ul>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" href="#">
                Admin
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                Logout
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Dashboard Content -->
    <div class="container">
      <h3>Welcome to Admin Dashboard</h3>
      <div class="row">
        <!-- Cards for quick stats -->
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Total Products</h5>
              <p class="card-text">120 Products</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Total Orders</h5>
              <p class="card-text">75 Orders</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">New Users</h5>
              <p class="card-text">20 Users</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Orders Table -->
      <div class="mt-4">
        <h4>Recent Orders</h4>
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Order ID</th>
              <th scope="col">User</th>
              <th scope="col">Amount</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>#001</td>
              <td>John Doe</td>
              <td>$120</td>
              <td><span class="badge bg-success">Completed</span></td>
            </tr>
            <tr>
              <td>#002</td>
              <td>Jane Smith</td>
              <td>$75</td>
              <td><span class="badge bg-warning">Pending</span></td>
            </tr>
            <tr>
              <td>#003</td>
              <td>Michael Lee</td>
              <td>$45</td>
              <td><span class="badge bg-danger">Cancelled</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS & Dependencies -->

</html>
