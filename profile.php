<?php
session_start();
include 'config.php';
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, display login button only
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Profile - Login Required</title>
        <link rel="stylesheet" href="css/profile.css">
        <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon-32x32.png">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
    <div class="container text-center mt-5">
        <div class="alert-box text-danger border-warning">
            <h2>Not logged in yet? Join now to explore exclusive men's fashion at Velvet Vogue!</h2>
            <button class="btn btn-warning mt-3" onclick="history.back()">Go Back</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/profile.css">
    <script src="javascript/profile.js"></script>
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon-32x32.png">
</head>
<body>

<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex justify-content-between">
            <a href="home.php" class="nav-link px-2 text-white fs-4">VELVET VOGUE</a>
            <div>
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
                    <img src="assets/profile.png" alt="Profile Picture" class="rounded-circle" width="150" height="150">
                    <h5 class="card-title mt-3"><?= htmlspecialchars($user['full_name']) ?></h5>
                    <p class="card-text">Email: <?= htmlspecialchars($user['email']) ?></p>
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
                                <td><?= htmlspecialchars($user['full_name']) ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Email</th>
                                <td><?= htmlspecialchars($user['email']) ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Address</th>
                                <td><?= htmlspecialchars($user['home_address']) ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Postal Code</th>
                                <td><?= htmlspecialchars($user['postal_code']) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="col-md-4 d-flex align-items-center">
            <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
                <img src="assets/brand.png" alt="Company Logo" width="30" height="24">
            </a>
            <span class="mb-3 mb-md-0 text-body-secondary">© 2024 Velvet Vogue Clothing Company. All rights reserved.</span>
        </div>

        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
            <li class="ms-3"><a class="text-body-secondary" href="#"><img src="assets/visa.png" alt="visa" width="32" height="32"></a></li>
            <li class="ms-3"><a class="text-body-secondary" href="#"><img src="assets/card.png" alt="mastercard" width="32" height="32"></a></li>
            <li class="ms-3"><a class="text-body-secondary" href="#"><img src="assets/american-express.png" alt="americanexpress" width="32" height="32"></a></li>
        </ul>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function signOut() {
    // Redirect to the logout script to end the session
    window.location.href = "logout.php";
}

</script>
</body>
</html>
