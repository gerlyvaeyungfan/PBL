<?php
session_start();

// Cek apakah pengguna sudah login dan memiliki role 'admin'
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'dosen') {
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
                <li>Dashboard</li>
                <li>Daftar Pelanggaran Mahasiswa</li>
                <li>Pengaturan</li>
                <li>Melaporkan</li>
                <li>Menerima Laporan</li>
                <li><a href="?logout=true">Logout</a></li> <!-- Menambahkan link logout -->
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content" >
            <div class="header1">
                <h1>Dashboard</h1>
            </div>
            <!-- <div class="notif">
                <h4>Notifikasi!</h4>
                    <div class ="garis"></div>
                    <p> Halo! Vera Efita Hudi Putri, kamu mendapatkan laporan pelanggaran</p>
                </div> -->
            <div class="content">
                
                <h2>Informasi Dosen</h2>
                <p class="info">Info! Berikut adalah biodata diri anda</p>
                
                <div class="biodata">
                    <img src="../view/ProfileDosen/dosen.png" alt="Foto Mahasiswa">
                    <table>
                        <tr>
                            <td>Nama</td>
                            <td>: Vit Zuraida, S.Kom.,M.Kom</td>
                        </tr>
                        <tr>
                            <td>NIDN</td>
                            <td>: 199011248</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>: Perempuan</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>: Malang</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>: vitzuraida@polinema.ac.id</td>
                        </tr>
                    </table>
                </div>
                <div class="buttons">
                    <button>Print</button>
                    <button>PDF</button>
                </div>
                
            </div>
            
        </div>
    </div>
    </div>
</body>

</html>