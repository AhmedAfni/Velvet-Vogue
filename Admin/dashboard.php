<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Dashboard</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

  <style>
    body {
      background-color: #f3f4f6;
    }
    .card {
      border: none;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    .table th, .table td {
      vertical-align: middle;
    }
    .btn-custom {
      border-radius: 50px;
    }
    .header-text {
      font-weight: 600;
      color: #333;
    }
    .primary-btn {
      background-color: #007bff;
      color: white;
      border: none;
    }
    .primary-btn:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>

<header class="p-3 bg-dark text-white shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="home.php" class="nav-link px-2 text-white fs-4">VELVET VOGUE</a>
        <button class="btn btn-danger" onclick="signOut()">Sign Out</button>
    </div>
</header>

  <div class="container mt-5">
    <h1 class="text-center mb-4 header-text">Product Management Dashboard</h1>

    <!-- Upload Product Section -->
    <div class="card mb-5">
      <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Upload New Product</h5>
      </div>
      <div class="card-body">
        <form>
          <div class="row g-3">
            <div class="col-md-6">
              <label for="productName" class="form-label">Product Name</label>
              <input type="text" class="form-control" id="productName" placeholder="Enter product name">
            </div>
            <div class="col-md-6">
              <label for="productImage" class="form-label">Product Image</label>
              <input type="file" class="form-control" id="productImage">
            </div>
          </div>
          <div class="mt-3">
            <label for="productDescription" class="form-label">Product Description</label>
            <textarea class="form-control" id="productDescription" rows="3" placeholder="Enter product description"></textarea>
          </div>
          <button type="submit" class="btn primary-btn mt-3 w-100 btn-custom">Upload Product</button>
        </form>
      </div>
    </div>

    <!-- Manage Products Section -->
    <div class="card">
      <div class="card-header bg-success text-white">
        <h5 class="mb-0">Manage Products</h5>
      </div>
      <div class="card-body">
        <table class="table table-hover align-middle">
          <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>Product Name</th>
              <th>Image</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Sample Product</td>
              <td>
                <img src="https://via.placeholder.com/60" alt="Product Image" class="img-thumbnail">
              </td>
              <td>
                <button class="btn btn-success btn-sm btn-custom me-2">Accept</button>
                <button class="btn btn-danger btn-sm btn-custom">Delete</button>
              </td>
            </tr>
            <!-- Add more rows as needed -->
          </tbody>
        </table>
      </div>
    </div>
  </div>


  <div class="container">
  <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
  <div class="col-md-4 d-flex align-items-center">
    <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
        <img src="assets/brand.png" alt="Company Logo" width="30" height="24">
    </a>
    <span class="mb-3 mb-md-0 text-body-secondary" style="white-space: nowrap;">© 2024 Velvet Vogue Clothing Company. All rights reserved.</span>
</div>

    <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
    <li class="ms-3"><a class="text-body-secondary" href="#"><img src="assets/visa.png" alt="visa" width="32" height="32"></a></li>
    <li class="ms-3"><a class="text-body-secondary" href="#"><img src="assets/card.png" alt="mastercard" width="32" height="32"></a></li>
    <li class="ms-3"><a class="text-body-secondary" href="#"><img src="assets/american-express.png" alt="americanexpress" width="32" height="32"></a></li>
</ul>
  </footer>
</div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
