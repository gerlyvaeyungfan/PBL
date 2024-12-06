<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TATIB Dashboard</title>
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
                <li>Daftar Data Mahasiswa</li>
                <li>Daftar Data Dosen</li>
                <button class="out">Logout</button>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header1">
                <h1>Daftar Pelanggaran Mahasiswa</h1>
            </div>
            <main class="content">
                <div class="form">
                    <label for="prodi">Pilih Prodi</label>
                    <select id="prodi">
                        <option value="" selected disabled></option>
                        <option value="ti">TI</option>
                        <option value="si">SIB</option>
                        <option value="si">PPLS</option>
                    </select>

                    <label for="kelas">Pilih Kelas</label>
                    <select id="kelas">
                        <option value="" selected disabled></option>
                        <option value="a">1A</option>
                        <option value="b">1B</option>
                        <option value="a">2A</option>
                        <option value="b">2B</option>
                        <option value="a">3A</option>
                        <option value="b">3B</option>
                        <option value="a">4A</option>
                        <option value="b">4B</option>
                    </select>

                    <button class="save">Simpan</button>
                </div>
            </main>

        </div>

    </div>
    </div>
    </div>
</body>

</html>