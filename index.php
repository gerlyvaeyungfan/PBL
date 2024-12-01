<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <title>SisiTatib</title>
    <style>
/*   Scroll effect */
        html {
            scroll-behavior: smooth;
        }
/*   / Scroll effect */

        /* Navbar Styles */
        .navbar {
            background-color: transparent;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .navbar.scrolled {
            background-color: #ffffff; /* Solid black */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .navbar-nav .nav-link {
            color: #fff;
            transition: color 0.3s ease;
        }

        .navbar.scrolled .nav-link {
            color: #000000;
        }

        /* Additional Styles */
        .section-title h2 {
            font-weight: bold;
        }

        .card-title a {
            text-decoration: none;
            color: #73b5cf;
        }

        .card-title a:hover {
            text-decoration: underline;
        }

        footer {
            background-color: #d6d5d5;
            color: #050505;
        }
    </style>

</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="view/HomepageImage/logoJti.png" width="50" height="50" alt="icon">
            <span class="ml-2 text-dark" href="#home" >SISTEM INFORMASI TATA TERTIB </span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#tentang">Tentang Kami</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#pelaporan">Pelaporan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#gallery">Kontak Kami</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Profile</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- /Navbar -->
<div id="home" class="hero-section" style="height: 100vh; background: url('view/HomepageImage/homepage.png') no-repeat center center/cover;">
    <div class="d-flex justify-content-center align-items-center h-100">
        <h1 class="text-white font-weight-bold">Sistem Informasi TATIB</h1>
    </div>
</div>
<!-- Card Section -->
<div id="pelaporan" class="container my-5">
    <div class="section-title text-center my-4">
        <h2>PELAPORAN PELANGGARAN</h2>
    </div>
    <br>
    <br>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card text-center shadow-sm p-3 mb-4">
                <div class="card-body">
                    <i class="fas fa-headset fa-3x mb-3"></i>
                    <h5 class="card-title">
                        <a href="#">Laporkan Pelanggaran</a>
                    </h5>
                    <p class="card-text">Anda akan memasuki laman khusus dalam hal pelanggaran umum.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow-sm p-3 mb-4">
                <div class="card-body">
                    <i class="fas fa-exclamation-circle fa-3x mb-3"></i>
                    <h5 class="card-title">
                        <a href="#">Laporkan Pelanggaran PPKS</a>
                    </h5>
                    <p class="card-text">Anda akan masuk ke laman pelanggaran khusus hal PPKS.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Card Section -->
<br>
<br>
<br>
<br>
<br>
<br>
<!--Tumbal buar scroll ke tentang-->
<div id="tentang"  class="text-brand" style="visibility: hidden">
    <h5>p</h5>
</div>
<!-- /Tumbal buar scroll ke tentang-->

<!-- Tentang Kami -->
<div class="container my-5">
    <div class="row">
        <div class="col-md-6">
            <h6 class="text-primary">Perkenalan</h6>
            <h3 class="font-weight-bold">Apasih itu SisiTaTiB?</h3>
            <p class="text-muted">
                <b>SisiTaTiB</b> merupakan website realtime dalam menunjang penegakan tata tertib di JTI dengan konsep *real-time processing*. Website ini memberikan informasi terkini dalam pelaporan, pelaksanaan sanksi, serta hal-hal lain yang berkaitan dengan tata tertib di JTI.
            </p>
            <img src="view/HomepageImage/tentangImage.png" alt="About Image" class="img-fluid rounded shadow">
        </div>
        <div class="col-md-6">
            <h6 class="text-primary">Alasan</h6>
            <h3 class="font-weight-bold">Mengapa harus di SisiTaTiB?</h3>
            <p class="text-muted">
                SisiTaTiB merupakan prototipe website yang membantu dalam urusan administrasi pelanggaran, baik pelanggaran umum maupun kekerasan. Dengan tampilan modern dan fitur-fitur yang relevan, website ini dirancang untuk mendukung berbagai aspek penegakan tata tertib di JTI.
            </p>
            <img src="view/HomepageImage/tentangImage.png" alt="Why Us Image" class="img-fluid rounded shadow">
        </div>
    </div>
</div>
<!-- /Tentang Kami -->

<!-- Footer -->
<footer class="text-center py-3">
    <p class="mb-0">© 2024 Kelompok 2 PBL. All rights reserved.</p>
</footer>
<!-- /Footer -->

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('.navbar').addClass('scrolled');
            } else {
                $('.navbar').removeClass('scrolled');
            }
        });
    });
</script>
</body>
</html>
