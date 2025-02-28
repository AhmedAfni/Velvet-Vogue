<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Velvet Vogue</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .contact-section {
            padding: 80px 0;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }
        .contact-info-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            height: 100%;
            transition: transform 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .contact-info-card:hover {
            transform: translateY(-5px);
        }
        .contact-icon {
            width: 60px;
            height: 60px;
            background: #f8f9fa;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }
        .contact-icon i {
            font-size: 24px;
            color: #0d6efd;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px;
            border: 1px solid #dee2e6;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(13,110,253,.15);
        }
        .map-container {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .contact-form {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
    </style>
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
        </div>
    </div>
</header>

<div class="contact-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h1 class="display-4 mb-3">Contact Us</h1>
                <p class="lead text-muted">We'd love to hear from you. Please get in touch with us.</p>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="contact-info-card">
                    <div class="contact-icon">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                    <h4>Visit Us</h4>
                    <p class="text-muted mb-0">123 Fashion Street</p>
                    <p class="text-muted">New York, NY 10001</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-info-card">
                    <div class="contact-icon">
                        <i class="bi bi-telephone"></i>
                    </div>
                    <h4>Call Us</h4>
                    <p class="text-muted mb-0">+1 (555) 123-4567</p>
                    <p class="text-muted">Mon-Fri, 9:00 AM - 6:00 PM</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-info-card">
                    <div class="contact-icon">
                        <i class="bi bi-envelope"></i>
                    </div>
                    <h4>Email Us</h4>
                    <p class="text-muted mb-0">info@velvetvogue.com</p>
                    <p class="text-muted">support@velvetvogue.com</p>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="contact-form">
                    <h3 class="mb-4">Send us a Message</h3>
                    <form action="submit_inquiry.php" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100">Send Message</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="map-container">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387193.30596670663!2d-74.25986548248684!3d40.69714941932609!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sin!4v1645523845317!5m2!1sen!2sin" 
                        width="100%" 
                        height="100%" 
                        style="border:0; min-height: 500px;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
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
            <span class="mb-3 mb-md-0 text-body-secondary" style="white-space: nowrap;"> 2024 Velvet Vogue Clothing Company. All rights reserved.</span>
        </div>

        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
            <li class="ms-3"><a class="text-body-secondary" href="#"><img src="assets/visa.png" alt="visa" width="32" height="32"></a></li>
            <li class="ms-3"><a class="text-body-secondary" href="#"><img src="assets/card.png" alt="mastercard" width="32" height="32"></a></li>
            <li class="ms-3"><a class="text-body-secondary" href="#"><img src="assets/american-express.png" alt="americanexpress" width="32" height="32"></a></li>
        </ul>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>