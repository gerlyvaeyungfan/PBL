<?php
session_start();

// Cek apakah pengguna sudah login dan memiliki role 'admin'
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php'); // Arahkan ke halaman login jika bukan admin
    exit;
}

// Menambahkan fitur logout
if (isset($_GET['logout'])) {
    session_destroy();  // Hapus sesi
    header('Location: ../login.php'); // Arahkan ke halaman login setelah logout
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TATIB Dashboard</title>
    <link rel="stylesheet" href="../view/Dosencss.css">
</head>

<body>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <a class="navbar-brand" href="#"></a>
        <img src="../view/ProfileDosen/jti.png">
        <p>Sistem Informasi Tata Tertib</p>
        <span class="navbar-toggler-icon"></span>
    </nav>

    <div class="container">

        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo"></div>
            <div class="user-info">
                <img src="../view/ProfileDosen/dosen.png" alt="Foto Dosen">
                <table>
                    <tr>
                        <td>Nama Dosen</td>
                    </tr>
                    <tr>
                        <td>NIDN</td>
                    </tr>
                </table>
                <br>
            </div>
            <ul class="menu">
                <p>MAIN MENU</p>
                <li>Periode: 2024/2025</li>
                <li><a href="admin_dashboard.php">Dashboard</a></li>
                <li><a href="admin_dashboard.php?page=pelanggaran">Daftar Pelanggaran Mahasiswa</a></li>
                <li><a href="admin_dashboard.php?page=data_mahasiswa">Daftar Data Mahasiswa</a></li>
                <li><a href="admin_dashboard.php?page=data_dosen">Daftar Data Dosen</a></li>
                <li><a href="admin_dashboard.php?page=daftar_akun">Daftar Data Akun</a></li>
                <li>Pengaturan</li>
                <li><a href="?logout=true">Logout</a></li> <!-- Menambahkan link logout -->
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header1">
                <h1>Dashboard</h1>
            </div>
        
            <div class="content">
                <?php
                // Logika untuk memuat konten sesuai dengan parameter "page"
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                    switch ($page) {
                        case 'daftar_akun':
                            include('../daftar_akun.php'); // Sertakan file daftar_akun.php
                            break;

                        case 'pelanggaran':
                            echo '<h2>Daftar Pelanggaran Mahasiswa</h2>';
                            echo '<p>Konten pelanggaran mahasiswa akan ditampilkan di sini.</p>';
                            break;

                        case 'data_mahasiswa':
                            echo '<h2>Daftar Data Mahasiswa</h2>';
                            echo '<p>Konten daftar mahasiswa akan ditampilkan di sini.</p>';
                            break;

                        case 'data_dosen':
                            echo '<h2>Daftar Data Dosen</h2>';
                            echo '<p>Konten daftar dosen akan ditampilkan di sini.</p>';
                            break;

                        default:
                            echo '<h2>Halaman tidak ditemukan</h2>';
                            break;
                    }
                } else {
                    // Konten default jika tidak ada parameter page
                    echo '<h2>Informasi Dosen</h2>';
                    echo '<p class="info">Info! Berikut adalah biodata diri anda</p>';
                    echo '<div class="biodata">
                        <img src="../view/ProfileDosen/dosen.png" alt="Foto Mahasiswa">
                        <table>
                            <tr><td>Nama</td><td>: Vit Zuraida, S.Kom.,M.Kom</td></tr>
                            <tr><td>NIDN</td><td>: 199011248</td></tr>
                            <tr><td>Jenis Kelamin</td><td>: Perempuan</td></tr>
                            <tr><td>Alamat</td><td>: Malang</td></tr>
                            <tr><td>Email</td><td>: vitzuraida@polinema.ac.id</td></tr>
                        </table>
                    </div>';
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>
