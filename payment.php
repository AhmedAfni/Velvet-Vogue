<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Velvet Vogue</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .payment-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 30px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .btn-pay {
            background-color: #ffc107;
            border: none;
            padding: 12px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s;
        }
        .btn-pay:hover {
            background-color: #ffca2c;
            transform: translateY(-2px);
        }
        footer {
            margin-top: auto;
            text-align: center;
            padding: 20px;
            background-color: white;
            border-top: 1px solid #dee2e6;
        }
        .form-control:focus {
            border-color: #ffc107;
            box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
        }
        .invalid-feedback {
            display: none;
            color: #dc3545;
            font-size: 0.875em;
        }
        .is-invalid {
            border-color: #dc3545 !important;
        }
        .is-invalid:focus {
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
        }
        .is-valid {
            border-color: #198754 !important;
        }
        .is-valid:focus {
            box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25) !important;
        }
    </style>
</head>
<body>

<div class="payment-container">
    <h3 class="text-center mb-4">Enter Payment Details</h3>
    
    <form id="paymentForm" novalidate>
        <!-- Card Number -->
        <div class="mb-3">
            <label for="cardNumber" class="form-label">Card Number</label>
            <input type="text" class="form-control" id="cardNumber" placeholder="1234 5678 9012 3456" maxlength="19" required>
            <div class="invalid-feedback" id="cardNumberError"></div>
        </div>

        <!-- Expiry Date -->
        <div class="mb-3">
            <label for="expiryDate" class="form-label">Expiry Date (MM/YY)</label>
            <input type="text" class="form-control" id="expiryDate" placeholder="MM/YY" maxlength="5" required>
            <div class="invalid-feedback" id="expiryDateError"></div>
        </div>

        <!-- CVV -->
        <div class="mb-3">
            <label for="cvv" class="form-label">CVV</label>
            <input type="text" class="form-control" id="cvv" placeholder="123" maxlength="3" required>
            <div class="invalid-feedback" id="cvvError"></div>
        </div>

        <!-- Cardholder Name -->
        <div class="mb-3">
            <label for="cardName" class="form-label">Cardholder Name</label>
            <input type="text" class="form-control" id="cardName" placeholder="Full Name" required>
            <div class="invalid-feedback" id="cardNameError"></div>
        </div>

        <!-- Pay Button -->
        <button type="submit" class="btn btn-pay w-100" id="payButton">Pay Now</button>
    </form>
</div>

<div id="paymentAlert" class="container mt-3"></div>

<footer>
    <p>&copy; 2024 Velvet Vogue Clothing Co. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Format credit card number with spaces
    function formatCardNumber(value) {
        const v = value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
        const matches = v.match(/\d{4,16}/g);
        const match = matches && matches[0] || '';
        const parts = [];

        for (let i = 0, len = match.length; i < len; i += 4) {
            parts.push(match.substring(i, i + 4));
        }

        if (parts.length) {
            return parts.join(' ');
        } else {
            return value;
        }
    }

    // Format expiry date
    function formatExpiryDate(value) {
        const v = value.replace(/\D/g, '');
        if (v.length >= 2) {
            return v.slice(0, 2) + (v.length > 2 ? '/' + v.slice(2, 4) : '');
        }
        return v;
    }

    // Validate expiry date
    function isValidExpiryDate(value) {
        if (!/^\d{2}\/\d{2}$/.test(value)) return false;

        const [month, year] = value.split('/');
        const currentDate = new Date();
        const currentYear = currentDate.getFullYear() % 100;
        const currentMonth = currentDate.getMonth() + 1;

        const expMonth = parseInt(month);
        const expYear = parseInt(year);

        if (expMonth < 1 || expMonth > 12) return false;
        if (expYear < currentYear) return false;
        if (expYear === currentYear && expMonth < currentMonth) return false;

        return true;
    }

    // Input event listeners for real-time validation and formatting
    document.getElementById('cardNumber').addEventListener('input', function(e) {
        let value = e.target.value;
        e.target.value = formatCardNumber(value);
        
        const cardNumber = value.replace(/\D/g, '');
        const isValid = cardNumber.length >= 16 && cardNumber.length <= 19;
        
        this.classList.toggle('is-invalid', !isValid);
        this.classList.toggle('is-valid', isValid);
        document.getElementById('cardNumberError').textContent = isValid ? '' : 'Card number must be 16-19 digits';
        document.getElementById('cardNumberError').style.display = isValid ? 'none' : 'block';
    });

    document.getElementById('expiryDate').addEventListener('input', function(e) {
        let value = e.target.value;
        e.target.value = formatExpiryDate(value);
        
        const isValid = isValidExpiryDate(value);
        this.classList.toggle('is-invalid', !isValid);
        this.classList.toggle('is-valid', isValid && value.length === 5);
        document.getElementById('expiryDateError').textContent = isValid ? '' : 'Please enter a valid future date';
        document.getElementById('expiryDateError').style.display = isValid ? 'none' : 'block';
    });

    document.getElementById('cvv').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        e.target.value = value;
        
        const isValid = value.length === 3;
        this.classList.toggle('is-invalid', !isValid);
        this.classList.toggle('is-valid', isValid);
        document.getElementById('cvvError').textContent = isValid ? '' : 'CVV must be 3 digits';
        document.getElementById('cvvError').style.display = isValid ? 'none' : 'block';
    });

    document.getElementById('cardName').addEventListener('input', function(e) {
        const value = e.target.value.trim();
        const isValid = value.length >= 3 && /^[a-zA-Z\s]+$/.test(value);
        
        this.classList.toggle('is-invalid', !isValid);
        this.classList.toggle('is-valid', isValid);
        document.getElementById('cardNameError').textContent = isValid ? '' : 'Please enter a valid name (letters and spaces only)';
        document.getElementById('cardNameError').style.display = isValid ? 'none' : 'block';
    });

    // Form submission handler
    document.getElementById('paymentForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validate all fields
        const cardNumber = document.getElementById('cardNumber').value;
        const expiryDate = document.getElementById('expiryDate').value;
        const cvv = document.getElementById('cvv').value;
        const cardName = document.getElementById('cardName').value.trim();

        const cardDigits = cardNumber.replace(/\D/g, '');
        const isCardValid = cardDigits.length >= 16 && cardDigits.length <= 19;
        const isExpiryValid = isValidExpiryDate(expiryDate);
        const isCvvValid = cvv.length === 3;
        const isNameValid = cardName.length >= 3 && /^[a-zA-Z\s]+$/.test(cardName);

        if (!isCardValid || !isExpiryValid || !isCvvValid || !isNameValid) {
            document.getElementById('paymentAlert').innerHTML = `
                <div class="alert alert-danger text-center">
                    <h4>Validation Error</h4>
                    <p>Please check all fields and try again.</p>
                </div>
            `;
            return;
        }

        // Disable submit button and show loading state
        const payButton = document.getElementById('payButton');
        const originalText = payButton.innerHTML;
        payButton.disabled = true;
        payButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...';

        // Process payment
        fetch('process_order.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                cardNumber: cardDigits,
                expiryDate: expiryDate,
                cvv: cvv,
                cardName: cardName
            })
        })
        .then(response => response.json())
        .then(data => {
            const alertDiv = document.getElementById('paymentAlert');
            if(data.success) {
                alertDiv.innerHTML = `
                    <div class="alert alert-success text-center">
                        <h4>Payment Successful!</h4>
                        <p>${data.message}</p>
                        <p>Your order number is: <strong>${data.order_number}</strong></p>
                        <a href="home.php" class="btn btn-warning mt-2">Continue Shopping</a>
                    </div>
                `;
                e.target.reset();
                // Reset validation states
                document.querySelectorAll('.is-valid').forEach(el => el.classList.remove('is-valid'));
            } else {
                alertDiv.innerHTML = `
                    <div class="alert alert-danger text-center">
                        <h4>Error</h4>
                        <p>${data.message}</p>
                    </div>
                `;
            }
        })
        .catch(error => {
            document.getElementById('paymentAlert').innerHTML = `
                <div class="alert alert-danger text-center">
                    <h4>Error</h4>
                    <p>An error occurred while processing your payment. Please try again.</p>
                </div>
            `;
        })
        .finally(() => {
            // Re-enable submit button
            payButton.disabled = false;
            payButton.innerHTML = originalText;
        });
    });
</script>
</body>
</html>
