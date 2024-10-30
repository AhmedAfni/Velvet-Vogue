<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css"> 
<body>

<div class="container">
    <h1>VELVET VOGUE</h1>
    <form>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" id="email" required />
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" required />
        </div>
        <button type="submit" class="btn">Login</button>
    </form>

    <div class="social-buttons">
    <p>or Login with:</p>
    <div class="social-icons"> 
        <button type="button" class="btn btn-link">
            <img src="../assets/facebook.png" alt="Facebook">
        </button>
        <button type="button" class="btn btn-link">
            <img src="../assets/google.png" alt="Google">
        </button>
        <button type="button" class="btn btn-link">
            <img src="../assets/twitter.png" alt="Twitter">
        </button>
    </div>

    <p class="text-center">Don't have an account? <a href="../php/signup.php" style="color: #ffcc00;">Sign up</a></p>
</div>

</body>
</html>