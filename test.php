<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SpaceX-Style Navbar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        /* Initial navbar styles (transparent) */
        .navbar {
            background-color: transparent;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        /* Solid background and shadow on scroll */
        .navbar.scrolled {
            background-color: #000; /* Solid black */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Optional shadow for depth */
        }

        .navbar-nav .nav-link {
            color: #fff;
            transition: color 0.3s ease;
        }

        /* Change text color on scroll */
        .navbar.scrolled .nav-link {
            color: #f9f9f9;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <a class="navbar-brand font-weight-bold" href="#">LOGO</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#about">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#launches">Launches</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#gallery">Gallery</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#contact">Contact</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Hero Section -->
<div class="hero-section" style="height: 100vh; background: url('https://via.placeholder.com/1920x1080') no-repeat center center/cover;">
    <div class="d-flex justify-content-center align-items-center h-100">
        <h1 class="text-white font-weight-bold">Welcome to SpaceX-Style</h1>
    </div>
</div>

<!-- Example Content -->
<section id="about" class="py-5">
    <div class="container">
        <h2 class="text-center">About</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempor eros id lorem aliquam, sit amet gravida libero aliquam.</p>
    </div>
</section>
<section class="contact-section">
    <div class="container">
        <div class="text-center mb-4">
            <h3 class="text-primary">Contact Info</h3>
        </div>
        <div class="row">
            <!-- Column 1: Service Info -->
            <div class="col-md-4 mb-4">
                <div class="contact-card p-3">
                    <h5 class="contact-title">Layanan Bantuan</h5>
                    <h6 class="font-weight-bold">SisiTaTiB</h6>
                </div>
            </div>
            <!-- Column 2: Email -->
            <div class="col-md-4 mb-4">
                <div class="contact-card p-3">
                    <h5 class="contact-title">Email Address</h5>
                    <p class="contact-info">help@info.com</p>
                    <p class="contact-info">Assistance hours: <br> Monday - Friday: 8 am to 8 pm EST</p>
                </div>
            </div>
            <!-- Column 3: Phone -->
            <div class="col-md-4 mb-4">
                <div class="contact-card p-3">
                    <h5 class="contact-title">Number</h5>
                    <p class="contact-info">(808) 908-34258</p>
                    <p class="contact-info">Assistance hours: <br> Monday - Friday: 8 am to 8 pm EST</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Navbar change on scroll
    $(document).ready(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 50) { // Adjust the scroll value as needed
                $('.navbar').addClass('scrolled');
            } else {
                $('.navbar').removeClass('scrolled');
            }
        });
    });
</script>
</body>
</html>
