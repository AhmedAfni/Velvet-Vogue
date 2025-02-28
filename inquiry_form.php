<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon-32x32.png">

</head>
<body class="bg-light">

<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li class="nav-item">
                    <a href="home.php" class="nav-link px-2 text-white fs-4">VELVET VOGUE</a>
                </li>
            </ul>
        </div>
    </div>
</header>

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 500px;">
        <h2 class="text-center text-primary mb-4">Inquiry Form</h2>
        <form action="submit_inquiry.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label"><i class="fas fa-user me-2"></i>Name:</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label"><i class="fas fa-envelope me-2"></i>Email:</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>

            <div class="mb-3">
                <label for="subject" class="form-label"><i class="fas fa-tag me-2"></i>Subject:</label>
                <input type="text" id="subject" name="subject" class="form-control" placeholder="Enter subject" required>
            </div>

            <div class="mb-3">
                <label for="message" class="form-label"><i class="fas fa-comment-dots me-2"></i>Message:</label>
                <textarea id="message" name="message" rows="5" class="form-control" placeholder="Enter your message" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
    </div>
</div>

<div class="container">
  <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <div class="col-md-4 d-flex align-items-center">
      <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
          <img src="assets/brand.png" alt="Company Logo" width="30" height="24">
      </a>
      <span class="mb-3 mb-md-0 text-body-secondary" style="white-space: nowrap;"> 2024 Velvet Vogue Clothing Company. All rights reserved.</span>
    </div>
  </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
