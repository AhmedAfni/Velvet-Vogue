<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pants</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/pants.css">
</head>
<body>

<header class="p-3 bg-dark text-white">
    <div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li class="nav-item">
            <a href="../php/index.php" class="nav-link px-2 text-white fs-4">VELVET VOGUE</a>
          </li>
        </ul>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
          <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
        </form>

        <div class="text-end">

        <button type="button" class="btn btn-warning me-2" data-bs-toggle="modal" data-bs-target="#loginModal">
            Account
        </button> 

        <a href="../php/profile.php" class="text-warning me-2" style="text-decoration: none; margin-left: 10px;">
            <img src="../assets/profile.png" alt="Company Logo" style="height: 30px; margin-right: 5px;">
        </a>
        
        </div>
    </div>
  </header>

  <div class="container">
    <header class="d-flex justify-content-center py-3">
      <ul class="nav nav-pills">
        <li class="nav-item"><a href="../php/home.php" class="nav-link">HOME</a></li>
        <li class="nav-item"><a href="../php/tshirt.php" class="nav-link" >T-SHIRTS</a></li>
        <li class="nav-item"><a href="../php/pants.php" class="nav-link active aria-current="page">PANTS</a></li>
        <li class="nav-item"><a href="../php/shorts.php" class="nav-link">SHORTS</a></li>
        <li class="nav-item"><a href="../php/hoodies.php" class="nav-link">HOODIES</a></li>
      </ul>
    </header>
  </div>

  <!-- Add your Pants specific content here --> 

  <div class="container">
    <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 my-5 border-top">
        <div class="col mb-3">
            <p class="text-body-secondary fw-bold fs-4" style="white-space: nowrap;">Velvet Vogue Clothing Company</p>
            <p class="text-body-secondary">Elevate your style with Velvet Vogue—where versatile men's fashion meets effortless confidence. Dress sharp, play hard!</p>
        </div>

        <div class="col mb-3"></div>

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
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Get Help</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Terms & Conditions</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Privacy Policy</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Return & Exchange</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Delivery Policy</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Order Tracking</a></li>
            </ul>
        </div>

        <div class="col mb-3">
            <h5>ABOUT</h5>
            <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Journal</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Our Story</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Contact</a></li>
            </ul>
        </div>
    </footer>
  </div>

  <div class="container">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <div class="col-md-4 d-flex align-items-center">
        <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
            <img src="../assets/brand.png" alt="Company Logo" width="30" height="24">
        </a>
        <span class="mb-3 mb-md-0 text-body-secondary" style="white-space: nowrap;">© 2024 Velvet Vogue Clothing Company. All rights reserved.</span>
    </div>

    <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
        <li class="ms-3"><a class="text-body-secondary" href="#"><img src="../assets/visa.png" alt="visa" width="32" height="32"></a></li>
        <li class="ms-3"><a class="text-body-secondary" href="#"><img src="../assets/card.png" alt="mastercard" width="32" height="32"></a></li>
        <li class="ms-3"><a class="text-body-secondary" href="#"><img src="../assets/american-express.png" alt="americanexpress" width="32" height="32"></a></li>
    </ul>
    </footer>
  </div>

  <!-- Modal for Login/Signup -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h1>VELVET VOGUE</h1>
                <form>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Enter your username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter your password">
                    </div>
                    <button type="submit" class="btn btn-warning w-100">Login</button>
                </form>

                <!-- New section for social login -->
                <div class="mt-3 text-center">
                    <p>or login with:</p>
                    <div class="social-icons"> 
                        <button type="button" class="btn btn-link">
                            <img src="../assets/facebook.png" alt="Facebook" style="width: 20px; height: 20px;">
                        </button>
                        <button type="button" class="btn btn-link">
                            <img src="../assets/google.png" alt="Google" style="width: 20px; height: 20px;">
                        </button>
                        <button type="button" class="btn btn-link">
                            <img src="../assets/twitter.png" alt="Twitter" style="width: 20px; height: 20px;">
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center align-items-center" style="background-color: #f8f9fa; padding: 15px;">
                <p class="mb-0 me-3" style="font-size: 1.1rem; font-weight: 500;">Don't have an account? 
                    <a href="#" data-bs-toggle="modal" data-bs-target="#signupModal" style="color: #ffcc00;">Sign up here</a>
                </p>
            </div>
        </div>
    </div>
  </div>

  <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">Sign Up</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h1>VELVET VOGUE</h1>
                <form action="../php/signup.php" method="POST"> <!-- Action to signup.php -->
                    <div class="mb-3">
                        <label for="signupFullName" class="form-label">Full name</label>
                        <input type="text" class="form-control" id="signupFullName" required placeholder="Enter your full name">
                    </div>
                    <div class="mb-3">
                        <label for="signupHomeAddress" class="form-label">Home address</label>
                        <input type="text" class="form-control" id="signupHomeAddress" required placeholder="Enter your home address">
                    </div>
                    <div class="mb-3">
                        <label for="signupPostalCode" class="form-label">Postal code</label>
                        <input type="text" class="form-control" id="signupPostalCode" required placeholder="Enter your postal code">
                    </div>
                    <div class="mb-3">
                        <label for="signupEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="signupEmail" required placeholder="Enter your email">
                    </div>
                    <div class="mb-3">
                        <label for="signupPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="signupPassword" required placeholder="Create a password">
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmPassword" required placeholder="Confirm your password">
                    </div>
                    <button type="submit" class="btn btn-warning w-100">Sign Up</button> <!-- Changed to btn-warning and w-100 -->
                </form>

                <div class="social-buttons mt-3 text-center">
                    <p>or Sign up with:</p>
                    <div class="social-icons d-flex justify-content-center"> 
                        <button type="button" class="btn btn-link">
                            <img src="../assets/facebook.png" alt="Facebook" style="width: 20px; height: 20px;">
                        </button>
                        <button type="button" class="btn btn-link">
                            <img src="../assets/google.png" alt="Google" style="width: 20px; height: 20px;">
                        </button>
                        <button type="button" class="btn btn-link">
                            <img src="../assets/twitter.png" alt="Twitter" style="width: 20px; height: 20px;">
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center align-items-center" style="background-color: #f8f9fa; padding: 15px;">
                <p class="mb-0 me-3" style="font-size: 1.1rem; font-weight: 500;">Already have an account? 
                    <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" style="color: #ffcc00;">Log in</a>
                </p>
            </div>
        </div>
    </div>
  </div>

</body>
</html>
