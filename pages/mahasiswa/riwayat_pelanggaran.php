<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TATIB Dashboard</title>
    <link rel="stylesheet" href="RiwayatPelanggarancss.css">
</head>

<body>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <a class="navbar-brand" href="#"></a>
        <img src="../SAKSI/img/jti.png">
        <p>Sistem Informasi Tata Tertib</p>
        <span class="navbar-toggler-icon"></span>
    </nav>

    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo"></div>
            <div class="user-info">
                <img src="../saksi/img/siswi1.jpeg" alt="Foto Mahasiswa">
                <table>
                    <tr>
                        <td>Nama Mahasiswa</td>
                    </tr>
                    <tr>
                        <td>NIM</td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                    </tr>
                </table>
                <br>
            </div>
            <ul class="menu">
                <p>MAIN MENU</p>
                <li>Periode: 2024/2025</li>
                <li>Dashboard</li>
                <li>Riwayat Pelanggaran</li>
                <button class="out">Logout</button>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header1">
                <h1>Riwayat Pelanggaran</h1>
            </div>
            <div class="content">
                <div class="table-header">
                <h2>Daftar Pelanggaran Anda</h2>
                <div class="filter-section">
                    <p>JTI - Politeknik Negeri Malang</p>
                </div>
                </div>
              
                <div class="table-header">
                </div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Dosen</th>
                            <th>Nama Mahasiswa</th>
                            <th>Tanggal Laporan</th>
                            <th>Pelanggaran</th>
                            <th>Tingkat</th>
                            <th>Cetak Sanksi</th>
                            <th>Bukti Sanksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="center-text">1</td>
                            <td class="center-text">xxxxxxxx</td>
                            <td class="center-text">Muhammad Rizky</td>
                            <td class="center-text">30/11/2024</td>
                            <td class="center-text">200</td>
                            <td class="center-text">xxxxxxxx</td>
                            <td><button class="button-view">print</button></td>
                            <td><button class="button-view">upload</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>