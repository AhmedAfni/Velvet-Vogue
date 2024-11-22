<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Gateway</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .payment-container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 500px;
            margin: 50px auto;
        }
        .btn-pay {
            background-color: #ffc107;
            border: none;
            color: #fff;
            padding: 12px;
            font-size: 1.1rem;
            border-radius: 5px;
            transition: 0.3s ease;
        }
        .btn-pay:hover {
            background-color: #e0a800;
            color: #fff;
        }
        footer {
            background-color: #343a40;
            color: #fff;
            padding: 15px 0;
            text-align: center;
        }
    </style>
</head>
<body>

<header class="p-3 bg-dark text-white">
    <div class="container">
        <h1 class="text-center">Secure Payment Gateway</h1>
    </div>
</header>

<div class="payment-container">
    <h3 class="text-center mb-4">Enter Payment Details</h3>
    
    <form>
        <!-- Card Number -->
        <div class="mb-3">
            <label for="cardNumber" class="form-label">Card Number</label>
            <input type="text" class="form-control" id="cardNumber" placeholder="1234 5678 9012 3456" required>
        </div>

        <!-- Expiry Date -->
        <div class="mb-3">
            <label for="expiryDate" class="form-label">Expiry Date (MM/YY)</label>
            <input type="text" class="form-control" id="expiryDate" placeholder="MM/YY" required>
        </div>

        <!-- CVV -->
        <div class="mb-3">
            <label for="cvv" class="form-label">CVV</label>
            <input type="password" class="form-control" id="cvv" placeholder="123" required>
        </div>

        <!-- Cardholder Name -->
        <div class="mb-3">
            <label for="cardName" class="form-label">Cardholder Name</label>
            <input type="text" class="form-control" id="cardName" placeholder="Full Name" required>
        </div>

        <!-- Pay Button -->
        <button type="submit" class="btn btn-pay w-100">Pay Now</button>
    </form>
</div>

<footer>
    <p>&copy; 2024 Velvet Vogue Clothing Co. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Optional: Add basic validation for expiry date format (MM/YY)
    document.getElementById('expiryDate').addEventListener('input', function (e) {
        const value = e.target.value;
        // Automatically add a slash ("/") after the second digit
        if (value.length === 2 && !value.includes('/')) {
            e.target.value = value + '/';
        }
    });
</script>
</body>
</html>
