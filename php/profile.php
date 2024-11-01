<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/profile.css"> 

    <script src="../javascript/profile.js"></script>
</head>
<body>

<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex justify-content-between">
            <a href="../php/home.php" class="nav-link px-2 text-white fs-4">VELVET VOGUE</a>
            <div>
                <button type="button" class="btn btn-warning me-2" data-bs-toggle="modal" data-bs-target="#cartModal">
                    <img src="../assets/cart.png" alt="Cart Logo" style="height: 20px; margin-right: 5px;"> Cart
                </button> 
                <button type="button" class="btn btn-danger" onclick="signOut()">
                    Sign Out
                </button>
            </div>
        </div>
    </div>
</header>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <img src="../assets/profile.png" alt="Profile Picture" class="rounded-circle" width="150" height="150">
                    <h5 class="card-title mt-3">John Doe</h5>
                    <p class="card-text">Email: johndoe@example.com</p>
                    <p class="card-text">Phone: +1234567890</p>
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</button>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <h3 class="mb-4">Account Information</h3>
            <div class="card">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0 bg-warning text-dark">User Details</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <th scope="row">Full Name</th>
                                <td>John Doe</td>
                            </tr>
                            <tr>
                                <th scope="row">Email</th>
                                <td>johndoe@example.com</td>
                            </tr>
                            <tr>
                                <th scope="row">Address</th>
                                <td>123 Main St, City, Country</td>
                            </tr>
                            <tr>
                                <th scope="row">Postal Code</th>
                                <td>12345</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editProfileForm">
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="fullName" value="John Doe" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" value="johndoe@example.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" value="+1234567890" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" value="123 Main St, City, Country" required>
                    </div>
                    <div class="mb-3">
                        <label for="postalCode" class="form-label">Postal Code</label>
                        <input type="text" class="form-control" id="postalCode" value="12345" required>
                    </div>
                    <button type="submit" class="btn btn-warning">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
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


</body>
</html>