<?php
session_start();

// Cek apakah pengguna sudah login dan memiliki role 'dosen'
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'dosen') {
    header('Location: login.php'); // Arahkan ke halaman login jika bukan dosen
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dosen Dashboard</title>
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
        <!-- Sidebar and Content here -->
    </div>
</body>

</html>
