<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TATIB Dashboard</title>
    <link rel="stylesheet" href="laporanPelanggaran1css.css">
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
                <li>Cek Laporan</li>
                <button class="out">Logout</button>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header1">
                <h1>Cek Laporan</h1>
            </div>
            <main class="content">
                <div class="table-section">
                    <div class="table-header">
                        <h2>Data Laporan</h2>
                        <div class="filter-section">
                            <p>JTI - Politeknik Negeri Malang</p>
                            <button class="button-filter">Filters</button>
                        </div>
                    </div>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama Mahasiswa</th>
                                <th>Tingkat Pelanggaran</th>
                                <th>Lihat</th>
                                <th>Konfirmasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>28/11/2024</td>
                                <td>Muhammad Rizky</td>
                                <td>I</td>
                                <td><button class="button-view">Lihat</button></td>
                                <td>
                                    <span class="icon-check-wrapper">
                                        <span class="icon-check">&#x2714;</span>
                                        <span class="icon-cross">&#x2718;</span>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>5/12/2024</td>
                                <td>Suci Putri Kinanti</td>
                                <td>I</td>
                                <td><button class="button-view">Lihat</button></td>
                                <td>
                                    <span class="icon-check-wrapper">
                                        <span class="icon-check">&#x2714;</span>
                                        <span class="icon-cross">&#x2718;</span>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>10/12/2024</td>
                                <td>Violin Snata Putra</td>
                                <td>II</td>
                                <td><button class="button-view">Lihat</button></td>
                                <td>
                                    <span class="icon-check-wrapper">
                                        <span class="icon-check">&#x2714;</span>
                                        <span class="icon-cross">&#x2718;</span>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>23/12/2024</td>
                                <td>Christian Bernard Samuel</td>
                                <td>IV</td>
                                <td><button class="button-view">Lihat</button></td>
                                <td>
                                    <span class="icon-check-wrapper">
                                        <span class="icon-check">&#x2714;</span>
                                        <span class="icon-cross">&#x2718;</span>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>24/12/2024</td>
                                <td>Intan Nur Aini</td>
                                <td>III</td>
                                <td><button class="button-view">Lihat</button></td>
                                <td>
                                    <span class="icon-check-wrapper">
                                        <span class="icon-check">&#x2714;</span>
                                        <span class="icon-cross">&#x2718;</span>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
    </div>
    </div>
</body>
</html>