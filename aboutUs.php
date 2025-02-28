<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Velvet Vogue</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/home.css">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon-32x32.png">
    
    <style>
        :root {
            --primary-color: #2c3e50;
            --accent-color: #e67e22;
            --light-bg: #f8f9fa;
            --dark-bg: #1a1a1a;
            --text-light: #ffffff;
            --text-dark: #2c3e50;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
        }

        .hero-section {
            background: linear-gradient(135deg, var(--dark-bg) 0%, #2c3e50 100%);
            color: var(--text-light);
            padding: 120px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(230, 126, 34, 0.1) 0%, rgba(44, 62, 80, 0.1) 100%);
            z-index: 1;
        }

        .hero-section .container {
            position: relative;
            z-index: 2;
        }

        .hero-section h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .hero-section .lead {
            font-size: 1.5rem;
            font-weight: 300;
            color: rgba(255, 255, 255, 0.9);
        }

        .about-section {
            padding: 100px 0;
            background-color: var(--text-light);
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 600;
            text-align: center;
            margin-bottom: 60px;
            color: var(--primary-color);
            position: relative;
            padding-bottom: 20px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background-color: var(--accent-color);
        }

        .feature-box {
            padding: 40px 30px;
            text-align: center;
            height: 100%;
            border-radius: 15px;
            background-color: var(--light-bg);
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .feature-box:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow);
            background-color: var(--text-light);
        }

        .feature-box h3 {
            color: var(--primary-color);
            font-size: 1.5rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .value-item {
            padding: 40px;
            background-color: var(--text-light);
            border-radius: 15px;
            box-shadow: var(--shadow);
            height: 100%;
            transition: all 0.3s ease;
        }

        .value-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.15);
        }

        .value-item h2 {
            color: var(--primary-color);
            font-size: 2rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .value-item li {
            color: var(--text-dark);
            font-size: 1.1rem;
            padding: 8px 0;
        }

        .value-item li::before {
            content: '✓';
            color: var(--accent-color);
            margin-right: 10px;
            font-weight: bold;
        }

        .testimonial {
            background-color: var(--light-bg);
            padding: 35px;
            border-radius: 15px;
            margin: 20px 0;
            height: 100%;
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .testimonial:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow);
            background-color: var(--text-light);
        }

        .testimonial p {
            font-size: 1.1rem;
            font-style: italic;
            color: var(--text-dark);
            line-height: 1.8;
        }

        .testimonial strong {
            color: var(--primary-color);
            font-size: 1.1rem;
        }

        footer {
            background: linear-gradient(135deg, var(--dark-bg) 0%, #2c3e50 100%);
        }

        .social-links a {
            transition: color 0.3s ease;
            text-decoration: none;
        }

        .social-links a:hover {
            color: var(--accent-color) !important;
        }

        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 2.5rem;
            }
            .hero-section .lead {
                font-size: 1.2rem;
            }
            .section-title {
                font-size: 2rem;
            }
            .value-item {
                padding: 25px;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
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

<main>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="display-3 fw-bold mb-4">Welcome to Velvet Vogue</h1>
            <p class="lead mb-0">Your Premier Destination for Contemporary Fashion</p>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h2 class="mb-4">Our Story</h2>
                    <p class="lead mb-4">Crafting Style Since 2020</p>
                    <p>At Velvet Vogue, we believe that fashion is more than just clothing – it's a form of self-expression that empowers individuals to showcase their unique personality and style. Our journey began with a simple vision: to create a fashion destination that combines quality, style, and affordability.</p>
                    <p>Today, we proudly serve fashion enthusiasts with our carefully curated collection of contemporary clothing, from casual wear to statement pieces that make you stand out.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="feature-section">
        <div class="container">
            <h2 class="section-title">Why Choose Us</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-box">
                        <h3>Quality First</h3>
                        <p>We source the finest materials and work with skilled craftsmen to ensure every piece meets our high standards.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <h3>Fast Delivery</h3>
                        <p>Enjoy quick and reliable shipping to your doorstep, with real-time tracking available.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <h3>Easy Returns</h3>
                        <p>Not satisfied? Our hassle-free return policy ensures your shopping experience remains worry-free.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission and Vision -->
    <section class="mission-vision">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="value-item">
                        <h2>Our Mission</h2>
                        <p>To provide our customers with high-quality, fashionable clothing that helps them express their individual style while maintaining affordability and sustainability in our practices.</p>
                        <ul class="list-unstyled mt-4">
                            <li class="mb-2">✓ Sustainable Fashion</li>
                            <li class="mb-2">✓ Affordable Luxury</li>
                            <li class="mb-2">✓ Exceptional Quality</li>
                            <li class="mb-2">✓ Customer Satisfaction</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="value-item">
                        <h2>Our Vision</h2>
                        <p>To become the leading fashion destination that inspires and empowers people to embrace their unique style while promoting sustainable and ethical fashion practices.</p>
                        <p class="mt-4">We strive to:</p>
                        <ul class="list-unstyled">
                            <li class="mb-2">✓ Set trends in sustainable fashion</li>
                            <li class="mb-2">✓ Create inclusive fashion for all</li>
                            <li class="mb-2">✓ Build a global fashion community</li>
                            <li class="mb-2">✓ Innovate in eco-friendly practices</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="about-section">
        <div class="container">
            <h2 class="section-title">What Our Customers Say</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="testimonial">
                        <p class="mb-3">"Amazing quality and style! The clothes are exactly as described and the delivery was super fast."</p>
                        <div class="d-flex justify-content-end">
                            <strong>- Sarah M.</strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="testimonial">
                        <p class="mb-3">"The best online shopping experience I've had. Great customer service and beautiful clothes!"</p>
                        <div class="d-flex justify-content-end">
                            <strong>- James R.</strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="testimonial">
                        <p class="mb-3">"Love the sustainable approach and the quality of the materials. Will definitely shop here again!"</p>
                        <div class="d-flex justify-content-end">
                            <strong>- Emily T.</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<footer class="bg-dark text-white py-4 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5>Contact Us</h5>
                <p>Email: info@velvetvogue.com<br>
                Phone: +1 (555) 123-4567<br>
                Address: 123 Fashion Street, Style City, ST 12345</p>
            </div>
            <div class="col-md-6">
                <h5>Follow Us</h5>
                <div class="social-links">
                    <a href="#" class="text-white me-3">Facebook</a>
                    <a href="#" class="text-white me-3">Instagram</a>
                    <a href="#" class="text-white">Twitter</a>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 text-center">
                <p class="mb-0">&copy; <?php echo date('Y'); ?> Velvet Vogue. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>