<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   
    <link rel="stylesheet" href="css/home.css">

    <script src="javascript/home.js"></script>

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

            <div class="text-end">
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <a href="login_page.php" class="btn btn-outline-warning me-2">LOGIN</a>
                    <a href="register_page.php" class="btn btn-warning me-2">REGISTER</a>
                <?php else: ?>
                    <a href="profile.php" class="text-warning me-2" style="text-decoration: none;">
                        <img src="assets/profile.png" alt="Profile" style="height: 30px;">
                    </a>
                    <a href="cart.php" class="text-warning me-2" style="text-decoration: none;">
                        <img src="assets/shopping-cart.png" alt="Cart" style="height: 30px;">
                    </a>
                    <a href="signout.php" class="btn btn-outline-warning">SIGN OUT</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>


  <div class="container">
    <header class="d-flex justify-content-center py-3">
      <ul class="nav nav-pills">
        <li class="nav-item"><a href="home.php" class="nav-link active"aria-current="page">HOME</a></li>
        <li class="nav-item"><a href="tshirt.php" class="nav-link" >T-SHIRTS</a></li>
        <li class="nav-item"><a href="pants.php" class="nav-link">PANTS</a></li>
        <li class="nav-item"><a href="shorts.php" class="nav-link">SHORTS</a></li>
        <li class="nav-item"><a href="hoodies.php" class="nav-link">HOODIES</a></li>
      </ul>
    </header>
  </div>

  <!-- Add your T-shirt specific content here --> 

<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>

  </div>

  <div class="carousel-inner">
    <div class="carousel-item active">
        <img src="assets/slider1.svg" class="d-block mx-auto" alt="First slide">
    </div>
    <div class="carousel-item">
        <img src="assets/slider0.svg" class="d-block mx-auto" alt="Second slide">
    </div>
    <div class="carousel-item">
        <img src="assets/slider3.svg" class="d-block mx-auto" alt="Third slide">
    </div>
    <div class="carousel-item">
        <img src="assets/slider4.svg" class="d-block mx-auto" alt="Third slide">
    </div>
</div>

<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <img src="assets/left.png" alt="Previous" style="width: 30px; height: 30px;"> <!-- Custom previous image -->
    <span class="visually-hidden">Previous</span>
  </button>

  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <img src="assets/next.png" alt="Next" style="width: 30px; height: 30px;"> <!-- Custom next image -->
    <span class="visually-hidden">Next</span>
  </button>
</div> 

<img src="assets/nameTagUPD.svg" alt="Under Image" style="width: 100%; height: auto; margin-top: 30px;"> 

<img src="assets/combo_offer.svg" alt="Under Image" style="width: 100%; height: auto; margin-top: 30px;">

<div class="container">
  <div class="row mt-4 justify-content-center gx-4 gy-3">
    <!-- Gift Coupon Cards -->
    <div class="col-auto">
      <div class="card shadow-lg rounded-lg" style="width: 180px; overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease;">
        <div class="card-img-wrapper position-relative" style="border-radius: 15px;">
          <img src="assets/_coupon.svg" class="card-img-top" alt="coupon" style="max-width: 100%; height: auto; border-radius: 15px;">
          <div class="badge bg-success text-white position-absolute top-0 end-0 m-2 badge-custom">Limited Offer</div>
        </div>
        <div class="card-body" style="background: linear-gradient(135deg, #ffffff, #f7f7f7); border-radius: 0 0 15px 15px;">
          <h5 class="card-title text-center" style="font-size: 1.2rem; font-weight: bold; color: #333;">Gift Coupon</h5>
          <p class="card-text text-center mb-2" style="font-size: 1.1rem; color: #555;">LKR. 2000.00</p>
          <a href="#" class="btn btn-custom w-100" style="background-color: #ffffff; color: #333; border-radius: 25px; font-weight: bold;">Gift Now</a>
        </div>
      </div>
    </div>

    <div class="col-auto">
      <div class="card shadow-lg rounded-lg" style="width: 180px; overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease;">
        <div class="card-img-wrapper position-relative" style="border-radius: 15px;">
          <img src="assets/_coupon.svg" class="card-img-top" alt="coupon" style="max-width: 100%; height: auto; border-radius: 15px;">
          <div class="badge bg-success text-white position-absolute top-0 end-0 m-2 badge-custom">Best Seller</div>
        </div>
        <div class="card-body" style="background: linear-gradient(135deg, #ffffff, #f7f7f7); border-radius: 0 0 15px 15px;">
          <h5 class="card-title text-center" style="font-size: 1.2rem; font-weight: bold; color: #333;">Gift Coupon</h5>
          <p class="card-text text-center mb-2" style="font-size: 1.1rem; color: #555;">LKR. 4000.00</p>
          <a href="#" class="btn btn-custom w-100" style="background-color: #ffffff; color: #333; border-radius: 25px; font-weight: bold;">Gift Now</a>
        </div>
      </div>
    </div>

    <div class="col-auto">
      <div class="card shadow-lg rounded-lg" style="width: 180px; overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease;">
        <div class="card-img-wrapper position-relative" style="border-radius: 15px;">
          <img src="assets/_coupon.svg" class="card-img-top" alt="coupon" style="max-width: 100%; height: auto; border-radius: 15px;">
          <div class="badge bg-success text-white position-absolute top-0 end-0 m-2 badge-custom">New Arrival</div>
        </div>
        <div class="card-body" style="background: linear-gradient(135deg, #ffffff, #f7f7f7); border-radius: 0 0 15px 15px;">
          <h5 class="card-title text-center" style="font-size: 1.2rem; font-weight: bold; color: #333;">Gift Coupon</h5>
          <p class="card-text text-center mb-2" style="font-size: 1.1rem; color: #555;">LKR. 6000.00</p>
          <a href="#" class="btn btn-custom w-100" style="background-color: #ffffff; color: #333; border-radius: 25px; font-weight: bold;">Gift Now</a>
        </div>
      </div>
    </div>

    <div class="col-auto">
      <div class="card shadow-lg rounded-lg" style="width: 180px; overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease;">
        <div class="card-img-wrapper position-relative" style="border-radius: 15px;">
          <img src="assets/_coupon.svg" class="card-img-top" alt="coupon" style="max-width: 100%; height: auto; border-radius: 15px;">
          <div class="badge bg-success text-white position-absolute top-0 end-0 m-2 badge-custom">Hot Deal</div>
        </div>
        <div class="card-body" style="background: linear-gradient(135deg, #ffffff, #f7f7f7); border-radius: 0 0 15px 15px;">
          <h5 class="card-title text-center" style="font-size: 1.2rem; font-weight: bold; color: #333;">Gift Coupon</h5>
          <p class="card-text text-center mb-2" style="font-size: 1.1rem; color: #555;">LKR. 8000.00</p>
          <a href="#" class="btn btn-custom w-100" style="background-color: #ffffff; color: #333; border-radius: 25px; font-weight: bold;">Gift Now</a>
        </div>
      </div>
    </div>

    <div class="col-auto">
      <div class="card shadow-lg rounded-lg" style="width: 180px; overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease;">
        <div class="card-img-wrapper position-relative" style="border-radius: 15px;">
          <img src="assets/_coupon.svg" class="card-img-top" alt="coupon" style="max-width: 100%; height: auto; border-radius: 15px;">
          <div class="badge bg-success text-white position-absolute top-0 end-0 m-2 badge-custom">Premium</div>
        </div>
        <div class="card-body" style="background: linear-gradient(135deg, #ffffff, #f7f7f7); border-radius: 0 0 15px 15px;">
          <h5 class="card-title text-center" style="font-size: 1.2rem; font-weight: bold; color: #333;">Gift Coupon</h5>
          <p class="card-text text-center mb-2" style="font-size: 1.1rem; color: #555;">LKR. 10000.00</p>
          <a href="#" class="btn btn-custom w-100" style="background-color: #ffffff; color: #333; border-radius: 25px; font-weight: bold;">Gift Now</a>
        </div>
      </div>
    </div>
  </div>
</div>


<style>
  .card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
  }

  .btn-custom {
    transition: background-color 0.3s ease;
  }

  .btn-custom:hover {
    background-color: #ffc107; /* Bootstrap warning color */
    color: white;
  }

  .badge-custom {
    font-size: 0.8rem;
    padding: 5px 10px;
    border-radius: 8px;
  }

  .card {
  max-width: 180px; /* Adjust this value as needed */
}

</style>


  <div class="container">
  <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 my-5 border-top">
    <div class="col mb-3">
     
      <p class="text-body-secondary fw-bold fs-4" style="white-space: nowrap;">Velvet Vogue Clothing Company</p>
      <p class="text-body-secondary">Elevate your style with Velvet Vogue—where versatile men's fashion meets effortless confidence. Dress sharp, play hard!</p>
    </div>

    <div class="col mb-3">

    </div>

    <div class="col mb-3">
      <h5>SHOP</h5>
      <ul class="nav flex-column">
        <li class="nav-item mb-2"><a href="tshirt.php" class="nav-link p-0 text-body-secondary">T-Shirts</a></li>
        <li class="nav-item mb-2"><a href="pants.php" class="nav-link p-0 text-body-secondary">Pants</a></li>
        <li class="nav-item mb-2"><a href="shorts.php" class="nav-link p-0 text-body-secondary">Shorts</a></li>
        <li class="nav-item mb-2"><a href="hoodies.php" class="nav-link p-0 text-body-secondary">Hoodies</a></li>
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
        <li class="nav-item mb-2"><a href="inquiry_form.php" class="nav-link p-0 text-body-secondary">Contact Us</a></li>
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
    <span class="mb-3 mb-md-0 text-body-secondary" style="white-space: nowrap;"> 2024 Velvet Vogue Clothing Company. All rights reserved.</span>
</div>

    <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
    <li class="ms-3"><a class="text-body-secondary" href="#"><img src="assets/visa.png" alt="visa" width="32" height="32"></a></li>
    <li class="ms-3"><a class="text-body-secondary" href="#"><img src="assets/card.png" alt="mastercard" width="32" height="32"></a></li>
    <li class="ms-3"><a class="text-body-secondary" href="#"><img src="assets/american-express.png" alt="americanexpress" width="32" height="32"></a></li>
</ul>
  </footer>
</div>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>

document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); 

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const alertContainer = document.getElementById('alertContainer');
    
    alertContainer.innerHTML = ''; 

    fetch('login.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email: email, password: password })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alertContainer.innerHTML = `
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    ${data.message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
            setTimeout(() => {
                location.reload();
            }, 2000); 
        } else {
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

var carousel = new bootstrap.Carousel(myCarousel, {
        interval: 0, 
        ride: 'carousel' 
    });


</script>
</html>
