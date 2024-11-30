<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>SisiTatib</title>
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body>
<div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <!--        Icon dan title web di navbar -->
        <div class="d-flex align-items-center">
            <img src="view/HomepageImage/logoJti.png" class="navbar-brand" width="50" height="50" alt="icon">
            <a class="navbar-brand mb-0 h1 ml-2 text-dark" href="#">SISTEM INFORMASI TATA TERTIB <span class="sr-only">(current)</span></a>
        </div>
        <!--       / Icon dan title web di navbar -->

        <!--Navbar-->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-muted" href="#tentang">Tentang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-muted" href="#">Kontak</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-muted" href="#">Profile</a>
                </li>
            </ul>
        </div>
    </nav>
</div>
<div>
    <img src="view/HomepageImage/HomeImage.jpg" class="img-fluid brand-image" alt="Responsive image" width="3500" height="500">
</div>
<!--/ navbar -->

<!--Card-->
<div class="container my-5">
    <div class="section-title text-center my-4 text-dark ">
        <h2>PELAPORAN PELANGGARAN</h2>
    </div>
    <div class="row justify-content-center pr-4"> <!-- Tambahkan gy-4 untuk jarak antar card -->
        <div class="col-md-4">
            <div class="card text-center shadow-sm p-3 mb-4">
                <div class="card-body">
                    <i class="fas fa-headset fa-3x mb-3"></i>
                    <h5 class="card-title">
                        <a href="#">Laporkan Pelanggaran</a>
                    </h5>
                    <p class="card-text">Anda akan memasuki laman khusus dalam hal pelanggaran umum. </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow-sm p-3 mb-4">
                <div class="card-body">
                    <i class="fas fa-headset fa-3x mb-3"></i>
                    <h5 class="card-title">
                        <a href="#">Laporkan pelanggaran PPKS</a>
                    </h5>
                    <p class="card-text">Anda akan masuk ke laman pelanggaran khusus hal ppks</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/Card-->
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

<!-- Tentang kami -->
<div class="container my-5">
    <div class="row">
        <!-- Section 1: Who We Are -->
        <div class="col-md-6 text-center text-md-left text-left pr-5">
            <h6 class="text-primary">Perkenalan</h6>
            <h3 class="font-weight-bold">Apasih itu SisiTaTiB ? </h3>
            <p class="text-muted text-justify">
                <b>SisiTaTiB</b> Merupakan Website realtime dalam menunjang penegakkan tata tertib di JTI dengan berdasar pada konsep realtime prosessing
                dimana ini akan memberikan informasi upTo date dalam pelaporan,pelaksanaan sanksi serta hal-hal lain yang berkaitan dengan sistem tata tertib di jti
            </p>
            <img src="view/HomepageImage/tentangImage.png" alt="Building" class="img-fluid rounded shadow">
        </div>

        <!-- Section 2: Why Us -->
        <div class="col-md-6 text-center text-md-left pr-5">
            <h6 class="text-primary">Alasan</h6>
            <h3 class="font-weight-bold">Mengapa harus di SisiTaTiB ? </h3>
            <p class="text-muted text-justify">
                SisiTaTiB merupakan Website <b>prototype</b> dalam rangka untuk project PBL dengan maksud Website ini membantu dalam urusan
                administrasi pelanggaran baik itu dalam golongan pelanggaran umum ataupun dalam pelanggaran kekerasan.
                    Menggunakan tampilan yang baik serta fitur yang pas untuk menunjang berbagai aspek dalam penegakkan tata tertib di <b>JTI</b>
            </p>
            <img src="view/HomepageImage/tentangImage.png" alt="Modern Building" class="img-fluid rounded shadow">
        </div>
    </div>
</div>

<footer class="bg-dark text-light text-center py-3">
    <p class="mb-0">© 2024 Kelompok 2 PBL . All rights reserved.</p>
</footer>
<!-- /Tentang kami -->
<!--Script -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>