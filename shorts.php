<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shorts</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/main.css">

    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon-32x32.png">
</head>
<body>

<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li class="nav-item">
                    <a href="index.php" class="nav-link px-2 text-white fs-4">VELVET VOGUE</a>
                </li>
            </ul>

            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                <input
                    type="search"
                    id="searchInput"
                    class="form-control form-control-dark"
                    placeholder="Search..."
                    aria-label="Search"
                >
            </form>

            <div class="text-end">
                <button type="button" class="btn btn-warning me-2" data-bs-toggle="modal" data-bs-target="#loginModal">
                    REGISTER
                </button> 

                <a href="profile.php" class="text-warning me-2" style="text-decoration: none;">
                    <img src="assets/profile.png" alt="Company Logo" style="height: 30px;">
                </a>

                <a href="cart.php" class="text-warning" style="text-decoration: none;">
                <img src="assets/shopping-cart.png" alt="Company Logo" style="height: 30px;">                </a>
            </div>
        </div>
    </div>
</header>


  <div class="container">
    <header class="d-flex justify-content-center py-3">
      <ul class="nav nav-pills">
        <li class="nav-item"><a href="home.php" class="nav-link">HOME</a></li>
        <li class="nav-item"><a href="tshirt.php" class="nav-link" >T-SHIRTS</a></li>
        <li class="nav-item"><a href="pants.php" class="nav-link">PANTS</a></li>
        <li class="nav-item"><a href="shorts.php" class="nav-link active"aria-current="page">SHORTS</a></li>
        <li class="nav-item"><a href="hoodies.php" class="nav-link">HOODIES</a></li>
      </ul>
    </header>
  </div>

  <!-- Add your Shorts specific content here -->
  <?php
// Include the database configuration file
include 'config.php';
session_start();
// Query to fetch product data from the database
$sql = "SELECT product_id, product_name, description, image_path, price FROM products WHERE product_type='shorts';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<div class="album py-5 bg-light">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">';

    // Loop through each product and display it
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col">
                <div class="card shadow-sm product-card">
                    <img src="' . $row['image_path'] . '" class="card-img-top" alt="' . $row['product_name'] . '">
                    <div class="card-body">
                        <p class="card-text">' . $row['description'] . '</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary" style="color: #000000; background-color: #f0ad4e; border-color: #f0ad4e;" data-bs-toggle="modal" data-bs-target="#productModal' . $row['product_id'] . '">
                                    View
                                </button>
                            </div>
                            <small class="text-muted">LKR. ' . number_format($row['price'], 2) . '</small>
                        </div>
                    </div>
                </div>
              </div>';

        // Modal for each product
        echo '<div class="modal fade" id="productModal' . $row['product_id'] . '" tabindex="-1" aria-labelledby="productModalLabel' . $row['product_id'] . '" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="productModalLabel' . $row['product_id'] . '">Choose Your Size</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body d-flex flex-column align-items-center">
                            <img src="' . $row['image_path'] . '" class="img-fluid mb-3" alt="' . $row['product_name'] . '" style="max-height: 200px;">
                            <h6 class="text-center mb-3">' . $row['product_name'] . '</h6>
                            <div class="mb-4 w-100">
                                <label class="form-label">Select Size</label>
                                <div class="d-flex justify-content-around">
                                    <div class="form-check">
                                        <input type="radio" id="sizeS' . $row['product_id'] . '" name="sizeSelect' . $row['product_id'] . '" value="S" class="form-check-input">
                                        <label for="sizeS' . $row['product_id'] . '" class="form-check-label">Small</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="sizeM' . $row['product_id'] . '" name="sizeSelect' . $row['product_id'] . '" value="M" class="form-check-input">
                                        <label for="sizeM' . $row['product_id'] . '" class="form-check-label">Medium</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="sizeL' . $row['product_id'] . '" name="sizeSelect' . $row['product_id'] . '" value="L" class="form-check-input">
                                        <label for="sizeL' . $row['product_id'] . '" class="form-check-label">Large</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="sizeXL' . $row['product_id'] . '" name="sizeSelect' . $row['product_id'] . '" value="XL" class="form-check-input">
                                        <label for="sizeXL' . $row['product_id'] . '" class="form-check-label">Extra Large</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" id="buyNowButton' . $row['product_id'] . '">Buy Now</button>
                            <button type="button" class="btn btn-warning" id="addToCartButton' . $row['product_id'] . '" onclick="addToCart(' . $row['product_id'] . ')">Add to Cart</button>
                        </div>
                    </div>
                </div>
              </div>';
    }

    echo '</div></div></div>';
} else {
    echo '<p>No products found.</p>';
}

// Close the database connection
$conn->close();
?>







  

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
        <form id="loginForm"> <!-- Added id for targeting in JS -->
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" required placeholder="Enter your email">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" required placeholder="Enter your password">
          </div>
          <button type="submit" class="btn btn-warning w-100">Login</button>
          <div id="loginError" class="text-danger mt-2" style="display: none;"></div> <!-- Error message display -->
        </form>

        <div class="mt-3 text-center">
          <p>or login with:</p>
          <div class="social-icons"> 
            <button type="button" class="btn btn-link">
                <img src="assets/facebook.png" alt="Facebook" style="width: 20px; height: 20px;">
            </button>
            <button type="button" class="btn btn-link">
                <img src="assets/google.png" alt="Google" style="width: 20px; height: 20px;">
            </button>
            <button type="button" class="btn btn-link">
                <img src="assets/twitter.png" alt="Twitter" style="width: 20px; height: 20px;">
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
<div id="alertContainer" tabindex="-3"></div> <!-- This will hold the alert message -->




<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signupModalLabel">Sign Up</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h1>VELVET VOGUE</h1>
        <form id="signupForm"> <!-- Removed action and method attributes -->
          <div class="mb-3">
            <label for="signupFullName" class="form-label">Full name</label>
            <input type="text" class="form-control" id="signupFullName" name="signupFullName" required placeholder="Enter your full name">
          </div>
          <div class="mb-3">
            <label for="signupHomeAddress" class="form-label">Home address</label>
            <input type="text" class="form-control" id="signupHomeAddress" name="signupHomeAddress" required placeholder="Enter your home address">
          </div>
          <div class="mb-3">
            <label for="signupPostalCode" class="form-label">Postal code</label>
            <input type="text" class="form-control" id="signupPostalCode" name="signupPostalCode" required placeholder="Enter your postal code">
          </div>
          <div class="mb-3">
            <label for="signupEmail" class="form-label">Email address</label>
            <input type="email" class="form-control" id="signupEmail" name="signupEmail" required placeholder="Enter your email">
          </div>
          <div class="mb-3">
            <label for="signupPassword" class="form-label">Password</label>
            <input type="password" class="form-control" id="signupPassword" name="signupPassword" required placeholder="Create a password">
          </div>
          <div class="mb-3">
            <label for="confirmPassword" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required placeholder="Confirm your password">
          </div>
          <button type="button" class="btn btn-warning w-100" id="signupButton">Sign Up</button>
        </form>
        <div class="social-buttons mt-3 text-center">
          <p>or Sign up with:</p>
          <div class="social-icons d-flex justify-content-center"> 
            <button type="button" class="btn btn-link">
                <img src="assets/facebook.png" alt="Facebook" style="width: 20px; height: 20px;">
            </button>
            <button type="button" class="btn btn-link">
                <img src="assets/google.png" alt="Google" style="width: 20px; height: 20px;">
            </button>
            <button type="button" class="btn btn-link">
                <img src="assets/twitter.png" alt="Twitter" style="width: 20px; height: 20px;">
            </button>
          </div>
        </div>
        <div id="signupAlert" class="mt-3"></div> <!-- For success/error messages -->
      </div>
      <div class="modal-footer d-flex justify-content-center align-items-center" style="background-color: #f8f9fa; padding: 15px;">
        <p class="mb-0 me-3" style="font-size: 1.1rem; font-weight: 500;">Already have an account? 
          <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" style="color: #ffcc00;">Log in</a>
        </p>
      </div>
    </div>
  </div>
</div>

<script>

document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent traditional form submission

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const alertContainer = document.getElementById('alertContainer');
    
    alertContainer.innerHTML = ''; // Clear any previous alerts

    fetch('login.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email: email, password: password })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            // Success alert
            alertContainer.innerHTML = `
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    ${data.message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
            setTimeout(() => {
                // Reload or redirect as needed after showing success message
                location.reload();
            }, 2000); // Delay for 2 seconds
        } else {
            // Error alert
            alertContainer.innerHTML = `
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ${data.message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Display generic error message
        alertContainer.innerHTML = `
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                An error occurred. Please try again.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
    });
});


document.getElementById('signupButton').addEventListener('click', function() {
  const formData = new FormData(document.getElementById('signupForm'));
  
  fetch('signup.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    const alertDiv = document.getElementById('signupAlert');
    if (data.success) {
      alertDiv.innerHTML = '<div class="alert alert-success">Account created successfully! You can now log in.</div>';
      document.getElementById('signupForm').reset();
    } else {
      alertDiv.innerHTML = '<div class="alert alert-danger">' + data.message + '</div>';
    }
  })
  .catch(error => console.error('Error:', error));
});

function addToCart(productId) {
    var size = document.querySelector('input[name="sizeSelect' + productId + '"]:checked');

    if (size) {
        var selectedSize = size.value;

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "add_to_cart.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Send the product ID and selected size to the server
        xhr.send("product_id=" + productId + "&size=" + selectedSize);

        xhr.onload = function () {
            if (xhr.status == 200) {
                alert(xhr.responseText); // Notify the user that the product was added
            } else {
                alert("Error adding product to cart.");
            }
        };
    } else {
        alert("Please select a size.");
    }
}
document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.getElementById("searchInput");
        const productCards = document.querySelectorAll(".product-card");

        searchInput.addEventListener("input", function () {
            const searchTerm = searchInput.value.toLowerCase();

            productCards.forEach(card => {
                const productName = card.querySelector(".card-text").textContent.toLowerCase();
                const productDescription = card.querySelector(".card-text").textContent.toLowerCase();

                if (productName.includes(searchTerm) || productDescription.includes(searchTerm)) {
                    card.parentElement.style.display = "block"; // Show parent column
                } else {
                    card.parentElement.style.display = "none"; // Hide parent column
                }
            });
        });
    });
</script>

</body>
</html>
