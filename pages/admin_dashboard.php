<?php
session_start();

// Cek apakah pengguna sudah login dan memiliki role 'admin'
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php'); // Arahkan ke halaman login jika bukan admin
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../view/Admincss.css">
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
                <img src="../view/ProfileDosen/admin.png" alt="Foto Admin">
                <table>
                    <tr>
                        <td>Nama Admin</td>
                    </tr>
                    <tr>
                        <td>NIP</td>
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
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header1">
                <h1>Admin Dashboard</h1>
            </div>
            <!-- Content here -->
        </div>
    </div>
</body>

</html>
