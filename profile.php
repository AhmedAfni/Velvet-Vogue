<?php
session_start();
include 'config.php';
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Required</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/profile.css">
    </head>
    <body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="alert alert-danger text-center p-5" style="border-radius: 12px;">
            <h2 class="alert-heading mb-4">Oops! You're not logged in.</h2>
            <p class="mb-4">Log in to explore the exclusive world of men's fashion at Velvet Vogue.</p>
            <a href="home.php" class="btn btn-danger btn-lg px-5">Log In</a>
        </div>
    </div>
    </body>
    </html>
    <?php
    exit;
}

// Retrieve user data from the database
$user_id = $_SESSION['user_id'];
$sql = "SELECT full_name, email, home_address, postal_code FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon-32x32.png">
</head>
<body>

<header class="p-3 bg-dark text-white shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="home.php" class="nav-link px-2 text-white fs-4">VELVET VOGUE</a>
        <button class="btn btn-danger" onclick="signOut()">Sign Out</button>
    </div>
</header>

<div class="container mt-5">
    <div class="row g-4">
        <!-- User Profile Card -->
        <div class="col-md-4">
            <div class="card text-center shadow-sm border-0">
                <div class="card-body">
                    <img src="assets/profile.png" alt="Profile Picture" class="rounded-circle mb-3" width="150" height="150">
                    <h4 class="card-title fw-bold mb-1"><?= htmlspecialchars($user['full_name']) ?></h4>
                    <p class="text-muted mb-3"><?= htmlspecialchars($user['email']) ?></p>
                    <button class="btn btn-warning w-75 mb-2" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        <i class="bi bi-pencil-square"></i> Edit Profile
                    </button>
                </div>
            </div>
        </div>

        <!-- User Account Details -->
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-warning text-dark fw-bold">
                    Account Information
                </div>
                <div class="card-body">
                    <table class="table table-borderless align-middle">
                        <tbody>
                            <tr>
                                <th class="text-muted">Full Name</th>
                                <td><?= htmlspecialchars($user['full_name']) ?></td>
                            </tr>
                            <tr>
                                <th class="text-muted">Email</th>
                                <td><?= htmlspecialchars($user['email']) ?></td>
                            </tr>
                            <tr>
                                <th class="text-muted">Address</th>
                                <td><?= htmlspecialchars($user['home_address']) ?></td>
                            </tr>
                            <tr>
                                <th class="text-muted">Postal Code</th>
                                <td><?= htmlspecialchars($user['postal_code']) ?></td>
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
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editProfileForm" action="update_profile.php" method="POST">
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="fullName" name="full_name" value="<?= htmlspecialchars($user['full_name']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="home_address" rows="3" required><?= htmlspecialchars($user['home_address']) ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="postalCode" class="form-label">Postal Code</label>
                        <input type="text" class="form-control" id="postalCode" name="postal_code" value="<?= htmlspecialchars($user['postal_code']) ?>" required>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-warning">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="col-md-4 d-flex align-items-center">
            <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
                <img src="assets/brand.png" alt="Company Logo" width="30" height="24">
            </a>
            <span class="mb-3 mb-md-0 text-body-secondary"> 2024 Velvet Vogue Clothing Company. All rights reserved.</span>
        </div>

        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
            <li class="ms-3"><a class="text-body-secondary" href="#"><img src="assets/visa.png" alt="visa" width="32" height="32"></a></li>
            <li class="ms-3"><a class="text-body-secondary" href="#"><img src="assets/card.png" alt="mastercard" width="32" height="32"></a></li>
            <li class="ms-3"><a class="text-body-secondary" href="#"><img src="assets/american-express.png" alt="americanexpress" width="32" height="32"></a></li>
        </ul>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function signOut() {
        window.location.href = "logout.php";
    }

    // Handle form submission
    document.getElementById('editProfileForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        fetch('update_profile.php', {
            method: 'POST',
            body: new FormData(this)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Your profile has been updated successfully.',
                    confirmButtonColor: '#ffc107'
                }).then(() => {
                    window.location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.message || 'Something went wrong!',
                    confirmButtonColor: '#ffc107'
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
                confirmButtonColor: '#ffc107'
            });
        });
    });
</script>
</body>
</html>
