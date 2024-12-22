
<?php
require_once 'controller/lib/Connection.php';

$connection = new Connection();
$conn = $connection->connect();

// Query untuk mengambil data dari tabel pelanggaran dengan JOIN ke tabel sanksi
$sql = "
SELECT 
    pelanggaran.deskripsi AS deskripsi_pelanggaran,
    pelanggaran.tingkat_sanksi,
    tingkat.deskripsi AS deskripsi_tingkat
FROM pelanggaran
LEFT JOIN tingkat
ON pelanggaran.tingkat_sanksi = tingkat.tingkat;
";
//Test
$stmt = sqlsrv_query($conn, $sql);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}
//elseif (!$stmt== true) {
//    die(print_r(sqlsrv_errors(), true));
//}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <title>Sistem Informasi Tata Tertib JTI Polinema</title>
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
            color: #889CFE;
        }

        .card-title a:hover {
            text-decoration: underline;
        }

        footer {
            background-color: #000000;
            color: #fafafa;
        }
    </style>

</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="view/img/jti.png" width="50" height="50" alt="icon">
            <span class="ml-2 text-dark" href="#home" >SISTEM INFORMASI TATA TERTIB </span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#informasi">Informasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">About us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- /Navbar -->
<div id="home" class="hero-section" style="height: 100vh; background: url('view/HomepageImage/homepage.png') no-repeat center center/cover;">
    <div class="d-flex justify-content-center align-items-center h-100">
        <h1 class="text-white font-weight-bold">SISTEM INFORMASI TATA TERTIB</h1>
    </div>
</div>
<br>
<br>
<br>
<br>

<!-- Tabel Informasi Tata Tertib -->
<div id="informasi" class="container mt-5">
    <h1 class="text-center mb-4">INFORMASI LIST  TATA TERTIB JTI </h1>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center shadow-sm p-3 mb-4">
                <div class="card-body">
                    <i class="fas fa-headset fa-3x mb-3"></i>
                    <p class="card-text"> <b class="text-primary">INFORMASI</b> <br>Anda memasuki website sistem informasi tata tertib JTI Polinema dimana website ini
                        memuat informasi mengenai laporan pelanggaran , informasi list tata tertib , sanksi dan tingkat serta informasi lainnya yang berkaitan dengan penunjang
                        penegakkan ketertiban di JTI Polinema <b>Catatan:</b> Untuk <b>tingkatan pelanggaran dimana semakin tinggi</b> tingkat pelanggaran maka sanksi yang dijatuhkan akan lebih ringan dibanding
                        dengan <b>tingkat pelanggaran  yang lebih rendah</b> maka sanksi yang di jatuhkan akan semakin berat</p>
                </div>
            </div>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Deskripsi Pelanggaran</th>
                <th>Tingkatan</th>
                <th>Deskripsi Sanksi</th>
            </tr>
            </thead>
            <tbody>
            <?php if ($stmt !== false && sqlsrv_has_rows($stmt)): ?>
                <?php while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['deskripsi_pelanggaran']) ?></td>
                        <td><?= htmlspecialchars($row['tingkat_sanksi']) ?></td>
                        <td><?= htmlspecialchars($row['deskripsi_tingkat'] ?? 'Tidak ada sanksi') ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">Tidak ada data.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <!-- /Table informasi tatib -->
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <!-- Tentang Kami -->
    <div id="about" class="container my-5">
        <h1 class="text-center mb-4">Konsep Website</h1>
        <div class="row justify-content-center">
            <!-- Card 1 -->
            <div class="col-md-6 mb-3 d-flex justify-content-center">
                <div class="card shadow-sm" style="width: 100%; max-width: 500px;">
                    <div class="card-body text-center">
                        <h6 class="text-primary">Flowchart</h6>
                        <h3 class="font-weight-bold">Sistem Tatib</h3>
                        <p class="text-muted">
                            <b>SisiTaTiB</b> merupakan website realtime dalam menunjang penegakan tata tertib di JTI dengan konsep *real-time processing*. Website ini memberikan informasi terkini dalam pelaporan, pelaksanaan sanksi, serta hal-hal lain yang berkaitan dengan tata tertib di JTI.
                        </p>
                        <a target="_blank" href="view/HomepageImage/tentangImage.png" class="d-block">
                            <img src="view/HomepageImage/tentangImage.png" alt="Flowchart Image" class="img-fluid rounded shadow" style="width:150px;">
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Card 1 -->

            <!-- Card 2 -->
            <div class="col-md-6 mb-3 d-flex justify-content-center">
                <div class="card shadow-sm" style="width: 100%; max-width: 500px;">
                    <div class="card-body text-center">
                        <h6 class="text-primary">Mockup</h6>
                        <h3 class="font-weight-bold">Sistem Tatib</h3>
                        <p class="text-muted">
                            <b>SisiTaTiB</b> merupakan prototipe website yang membantu dalam urusan administrasi pelanggaran, baik pelanggaran umum maupun kekerasan. Dengan tampilan modern dan fitur-fitur yang relevan, website ini dirancang untuk mendukung berbagai aspek penegakan tata tertib di JTI.
                        </p>
                        <a target="_blank" href="view/HomepageImage/tentangImage.png" class="d-block">
                            <img src="view/HomepageImage/tentangImage.png" alt="Mockup Image" class="img-fluid rounded shadow" style="width:150px;">
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Card 2 -->
        </div>
    </div>
    <!-- /Tentang Kami -->

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
    <!-- /Scripts -->

</body>
</html>