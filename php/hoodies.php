<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/hoodies.css">
</head>
<body>


<!-- Top navigation bar -->
<nav class="py-2 bg-body-tertiary border-bottom">
  <div class="container d-flex flex-wrap justify-content-between align-items-center">

    <!-- Brand/logo -->
    <a href="../php/index.php" class="d-flex align-items-center mb-3 mb-lg-0 link-body-emphasis text-decoration-none">
      <span class="fs-4">VELVET VOGUE</span>
    </a>
    
    <!-- Login and Signup links -->
    <ul class="nav">

      <!-- Account dropdown -->
      <li class="nav-item dropdown">

        <!-- Account dropdown toggle button -->
        <a class="nav-link dropdown-toggle text-dark" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Account
        </a>

        <!-- Account dropdown menu -->
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdown">
          <li><a class="dropdown-item" href="#">Login</a></li>
          <li><a class="dropdown-item" href="#">Sign up</a></li>
        </ul>
      </li>
      
      <!-- Profile icon -->
      <li class="nav-item">
        <a href="#" class="nav-link">
          <!-- SVG icon for profile -->
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-circle text-dark" viewBox="0 0 16 16">
            <!-- Circle for the head -->
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
            <!-- Outer circle and body -->
            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
          </svg>
        </a>
      </li>
    </ul>
  </div>
</nav>

<!-- Main header with navigation and search -->
<header class="py-3 mb-4 border-bottom">
  <div class="container">
    <div class="row align-items-center">

      <!-- Left column: placeholder for logo or other content -->
      <div class="col-lg-4 d-flex justify-content-lg-start justify-content-center">
        <a href="/" class="d-flex align-items-center link-body-emphasis text-decoration-none">
          <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
        </a>
      </div>

      <!-- Center column: main navigation menu -->
      <div class="col-lg-4 d-flex justify-content-center">
        <nav>
          <ul class="nav">
            <li class="nav-item"><a href="../php/home.php" class="nav-link link-body-emphasis px-2">HOME</a></li>
            <li class="nav-item"><a href="../php/tshirt.php" class="nav-link link-body-emphasis px-2">T-SHIRTS</a></li>
            <li class="nav-item"><a href="../php/pants.php" class="nav-link link-body-emphasis px-2">PANTS</a></li>
            <li class="nav-item"><a href="../php/shorts.php" class="nav-link link-body-emphasis px-2">SHORTS</a></li>
            <li class="nav-item"><a href="../php/hoodies.php" class="nav-link link-body-emphasis px-2 active" aria-current="page">HOODIES</a></li>
          </ul>
        </nav>
      </div>

      <!-- Right column: search form -->
      <div class="col-lg-4 d-flex justify-content-lg-end justify-content-center mt-3 mt-lg-0">
        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
          <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
        </form>
      </div>

    </div>
  </div>
</header>


<div class="container">
  <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 my-5 border-top">
    <div class="col mb-3">
      <h5>VELVET VOGUE</h5> <br>
      <p class="text-body-secondary">Velvet Vogue is all about redefining men's style with versatile clothing that fits your dynamic lifestyle—whether at work, out with friends, or on the move.</p>
    </div>

    <div class="col mb-3">
    </div>

    <div class="col mb-3">
      <h5>SHOP</h5>
      <ul class="nav flex-column">
        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">T-Shirts</a></li>
        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Pants</a></li>
        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Shorts</a></li>
        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Hoodies</a></li>
      </ul>
    </div>

    <div class="col mb-3">
      <h5>HELP</h5>
      <ul class="nav flex-column">
        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Home</a></li>
        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Features</a></li>
        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Pricing</a></li>
        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">FAQs</a></li>
        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">About</a></li>
      </ul>
    </div>

    <div class="col mb-3">
      <h5>ABOUT</h5>
      <ul class="nav flex-column">
        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Home</a></li>
        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Features</a></li>
        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Pricing</a></li>
        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">FAQs</a></li>
        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">About</a></li>
      </ul>
    </div>
  </footer>
</div>
    
</body>
</html>
