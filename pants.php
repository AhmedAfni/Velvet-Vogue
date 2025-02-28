<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pants</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/main.css">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon-32x32.png">
</head>
<body>

<?php 
include 'includes/header.php'; 
include 'config.php';

// Query to fetch product data from the database
$sql = "SELECT product_id, product_name, description, image_path, price FROM products WHERE product_type='pants';";
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function addToCart(productId) {
    var size = document.querySelector('input[name="sizeSelect' + productId + '"]:checked');
    
    if (!size) {
        Swal.fire({
            icon: 'error',
            title: 'Please Select a Size',
            text: 'You must select a size before adding to cart',
            confirmButtonColor: '#3085d6'
        });
        return;
    }

    const formData = new FormData();
    formData.append('product_id', productId);
    formData.append('size', size.value);

    fetch('add_to_cart.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: data.message,
                confirmButtonColor: '#3085d6'
            });
        } else if (data.requireLogin) {
            Swal.fire({
                icon: 'warning',
                title: 'Not Logged In',
                text: data.message,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Login Now',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = data.loginUrl;
                }
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.message,
                confirmButtonColor: '#3085d6'
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong! Please try again.',
            confirmButtonColor: '#3085d6'
        });
    });
}

document.addEventListener("DOMContentLoaded", function () {
    // Add event listeners for Buy Now buttons
    const buyNowButtons = document.querySelectorAll('[id^="buyNowButton"]');
    buyNowButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Add your buy now logic here
            Swal.fire({
                icon: 'info',
                title: 'Coming Soon',
                text: 'Buy Now functionality will be available soon!',
                confirmButtonColor: '#3085d6'
            });
        });
    });
});
</script>

</body>
</html>
