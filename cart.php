<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon-32x32.png">


    <script>
        // Function to update the price dynamically based on quantity
        function updatePrice(element, price) {
            const quantity = parseInt(element.value);
            const totalPriceElement = element.closest('.row').querySelector('.total-price');
            if (totalPriceElement) {
                totalPriceElement.textContent = 'LKR ' + (price * quantity).toFixed(2);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Add event listeners to quantity inputs for increase/decrease
            const quantityInputs = document.querySelectorAll('input[name="quantity"]');

            quantityInputs.forEach(input => {
                input.addEventListener('change', function() {
                    const price = parseFloat(input.closest('.row').querySelector('.price').dataset.price);
                    updatePrice(input, price);
                });
            });

            // Increase and decrease buttons
            const decreaseButtons = document.querySelectorAll('.decrease-quantity');
            const increaseButtons = document.querySelectorAll('.increase-quantity');

            decreaseButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const quantityInput = button.closest('.col-md-3').querySelector('input[name="quantity"]');
                    if (quantityInput.value > 1) {
                        quantityInput.value = parseInt(quantityInput.value) - 1;
                        const price = parseFloat(quantityInput.closest('.row').querySelector('.price').dataset.price);
                        updatePrice(quantityInput, price);
                    }
                });
            });

            increaseButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const quantityInput = button.closest('.col-md-3').querySelector('input[name="quantity"]');
                    quantityInput.value = parseInt(quantityInput.value) + 1;
                    const price = parseFloat(quantityInput.closest('.row').querySelector('.price').dataset.price);
                    updatePrice(quantityInput, price);
                });
            });
        });
    </script>
</head>
<body>

<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li class="nav-item">
                    <a href="home.php" class="nav-link px-2 text-white fs-4">VELVET VOGUE</a>
                </li>
            </ul>

            <div class="text-end">
                <a href="profile.php" style="text-decoration: none;">
                    <button type="button" class="btn btn-warning me-2">
                        <img src="assets/profile.png" alt="Profile Picture" style="height: 20px; margin-right: 5px;">
                        PROFILE
                    </button>
                </a>
            </div>
        </div>
    </div>
</header>

<?php
session_start();
include 'config.php'; // Include the database connection file

// Ensure user is logged in (no guest users allowed)
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if (!$user_id) {
    echo 'Error: User not logged in.';
    exit;
}

// Fetch the cart items from the database for the logged-in user
$sql = "SELECT cart.cart_id, cart.product_id, cart.size, cart.quantity, products.product_name, products.price, products.image_path
        FROM cart 
        JOIN products ON cart.product_id = products.product_id
        WHERE cart.user_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// If the cart is empty
if ($result->num_rows == 0) {
    echo 
    '<div class="alert alert-warning text-center p-5" style="background-color: #fff3cd; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <h4 class="alert-heading">Oops!</h4>
        <p>Your cart is currently empty. Start shopping and fill it up with your favorites!</p>
        <a href="home.php" class="btn btn-warning btn-lg">Go Shopping</a>
    </div>';
    exit;
}
?>

<section class="h-100">
  <div class="container h-100 py-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-10">

        <div class="d-flex justify-content-between align-items-center mb-4">
          <h3 class="fw-normal mb-0">Shopping Cart</h3>
        </div>

        <?php while ($cart_item = $result->fetch_assoc()): ?>
        <div class="card rounded-3 mb-4">
          <div class="card-body p-4">
            <div class="row d-flex justify-content-between align-items-center">
              
              <div class="col-md-2 col-lg-2 col-xl-2">
                <img
                  src="<?php echo htmlspecialchars($cart_item['image_path']); ?>"
                  class="img-fluid rounded-3" alt="<?php echo htmlspecialchars($cart_item['product_name']); ?>">
              </div>
              <div class="col-md-3 col-lg-3 col-xl-3">
                <p class="lead fw-normal mb-2"><?php echo htmlspecialchars($cart_item['product_name']); ?></p>
                <p><span class="text-muted">Size: </span><?php echo htmlspecialchars($cart_item['size']); ?></p>
              </div>
              <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                <button class="btn btn-link px-2 decrease-quantity">
                  <i class="fas fa-minus"></i>
                </button>

                <input id="form1" min="0" name="quantity" value="<?php echo $cart_item['quantity']; ?>" type="number" class="form-control form-control-sm" />

                <button class="btn btn-link px-2 increase-quantity">
                  <i class="fas fa-plus"></i>
                </button>
              </div>
              <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1 price" data-price="<?php echo $cart_item['price']; ?>">
                <h5 class="mb-0 total-price">LKR <?php echo number_format($cart_item['price'] * $cart_item['quantity'], 2); ?></h5>
              </div>

              <div class="col-md-1 col-lg-1 col-xl-1 d-flex justify-content-center">

                <form action="remove_from_cart.php" method="get" class="d-inline">
                  <input type="hidden" name="cart_id" value="<?php echo $cart_item['cart_id']; ?>">
                  <button type="submit" class="btn btn-link text-danger p-0" style="border: none; background: none;">
                  <img src="assets/delete.png" alt="Delete" style="height: 20px; width: 20px;">
                  </button>
                </form>

              </div>
            </div>
          </div>
        </div>
        <?php endwhile; ?>

        <div class="card mb-4 shadow-sm rounded" style="border: none;">
            <div class="card-body p-4 d-flex flex-row align-items-center" style="background-color: #f9f9f9; border-radius: 10px;">
                <div data-mdb-input-init class="form-outline flex-fill">
                    <input type="text" id="form1" class="form-control form-control-lg" style="border-radius: 10px; border: 1px solid #ffc107;" placeholder="Enter discount code" />
                </div>

                <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-warning btn-lg ms-3" style="border-radius: 10px; border-width: 2px; transition: 0.3s;">
                    Apply
                </button>
            </div>
        </div>

        <div class="card shadow-sm rounded" style="border: none;">
            <div class="card-body" style="padding: 20px; background-color: #fdf7e2; border-radius: 10px;">
                <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-warning btn-block btn-lg w-100" style="border-radius: 10px; transition: 0.3s;">
                    Checkout
                </button>
            </div>
        </div>

      </div>
    </div>
  </div>
</section>

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

</body>
</html>
