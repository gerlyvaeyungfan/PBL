<?php
// Memulai sesi di header.php sehingga hanya dimulai sekali
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    $_SESSION['role'] = 'admin';
}

// Cek apakah pengguna sudah login dan memiliki role 'admin'
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../../login.php'); // Arahkan ke halaman login jika bukan admin
    exit;
}

// Menambahkan fitur logout
if (isset($_GET['logout'])) {
    session_destroy();  // Hapus sesi
    header('Location: ../../login.php'); // Arahkan ke halaman login setelah logout
    exit;
}

// Koneksi ke database
include('../../controller/lib/Connection.php');

$connection = new Connection();
$conn = $connection->connect();

// Memulai output buffering
ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SisITaTib JTI Polinema</title>
    <link rel="stylesheet" href="../../view/style/Admincss.css">
</head>

<body>
    <!-- Sidebar -->
    <?php include('../navbar.php');?>

    <div class="container">

        <!-- Sidebar -->
        <?php include('sidebar_admin.php');?>

        <!-- Main Content -->
        <div class="main-content">
        <?php include('header_admin.php');

            if (isset($_GET['page'])) {
                $page = $_GET['page'];
                switch ($page) {
                    case 'daftar_akun':
                        include('daftar_akun.php'); // Sertakan file daftar_akun.php
                        break;
                    case 'pelanggaran':
                        include('riwayat_pelanggaran.php');
                        break;
                    case 'data_pelanggaran':
                        include('data_pelanggaran.php');
                        break;

                    case 'data_sanksi':
                        include('data_sanksi.php');
                        break;

                    case 'data_mahasiswa':
                        // Query untuk mendapatkan data mahasiswa
                        $query = "SELECT m.id, m.nama, m.nim, m.jk, m.prodi, m.kelas, d.nama [Nama DPA], m.foto_mahasiswa
                        FROM mahasiswa m
                        INNER JOIN dosen d
                        ON m.dpa_id = d.id";
                        $stmt = sqlsrv_query($conn, $query);

                        // Menyimpan hasil query dalam array
                        $mahasiswa = [];
                        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                        $mahasiswa[] = $row; // Menambahkan setiap data ke array $mahasiswa
                        }

                        include('data_mahasiswa.php');
                        sqlsrv_free_stmt($stmt);
                        break;
                        case 'edit_akun':
                            include('edit_akun.php');
                            break;
                        case 'hapus_akun':
                            include('hapus_akun.php');
                            break;

                        case 'tambah_akun':
                            include('register.php');
                            break;
                        case 'detail_dosen':
                            include('detail_dosen.php');
                            break;
                        case 'detail_mahasiswa':
                            include('detail_mahasiswa.php');
                            break;
                        case 'edit_mahasiswa':
                            include('edit_mahasiswa.php');
                            break;

                        case 'tambah_mahasiswa':
                        // Query untuk mengambil data unik dari kolom prodi dan kelas
                        $query_prodi = "SELECT DISTINCT prodi FROM mahasiswa";
                        $query_kelas = "SELECT DISTINCT kelas FROM mahasiswa";

                        $result_prodi = sqlsrv_query($conn, $query_prodi);
                        $result_kelas = sqlsrv_query($conn, $query_kelas);

                        // Menyimpan data ke array
                        $prodi_options = [];
                        $kelas_options = [];

                        while ($row = sqlsrv_fetch_array($result_prodi, SQLSRV_FETCH_ASSOC)) {
                            $prodi_options[] = $row['prodi'];
                        }
                        while ($row = sqlsrv_fetch_array($result_kelas, SQLSRV_FETCH_ASSOC)) {
                            $kelas_options[] = $row['kelas'];
                        }
                        // Query untuk mengambil data dosen
                        $query_dosen = "SELECT id, nama FROM dosen";
                        $result_dosen = sqlsrv_query($conn, $query_dosen);

                        // Menyimpan data dosen ke array
                        $dpa_options = [];
                        while ($row = sqlsrv_fetch_array($result_dosen, SQLSRV_FETCH_ASSOC)) {
                            $dpa_options[] = [
                                'id' => $row['id'],
                                'nama' => $row['nama']
                            ];
                        }
                        // Proses tambah mahasiswa
                        if (isset($_POST['add-mhs'])) {
                            $username = $_POST['username'];
                            $nama = $_POST['nama'];
                            $nim = $_POST['nim'];
                            $jk = $_POST['jk'];
                            $ttl = $_POST['ttl'];
                            $alamat = $_POST['alamat'];
                            $email = $_POST['email'];
                            $prodi = $_POST['prodi'];
                            $kelas = $_POST['kelas'];
                            $dpa_id = $_POST['dpa_id'];

                            // Proses upload foto
                            $foto_mahasiswa = null;
                            if (!empty($_FILES['foto_mahasiswa']['name'])) {
                                $targetDir = "../../view/img/mahasiswa/";
                                $foto_mahasiswa = $targetDir . basename($_FILES['foto_mahasiswa']['name']);
                                move_uploaded_file($_FILES['foto_mahasiswa']['tmp_name'], $foto_mahasiswa);
                            }

                            // Simpan data ke tabel mahasiswa
                            $query = "INSERT INTO mahasiswa (nama, nim, jk, ttl, alamat, email, prodi, kelas, dpa_id, foto_mahasiswa) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                            $params = array($nama, $nim, $jk, $ttl, $alamat, $email, $prodi, $kelas, $dpa_id, $foto_mahasiswa);
                            $stmt = sqlsrv_query($conn, $query, $params);

                            if ($stmt === false) {
                                echo "Error: " . sqlsrv_errors();
                            } else {
                                header('Location: admin_dashboard.php?page=data_mahasiswa');  // Redirect ke halaman sukses
                                exit;  // Pastikan tidak ada kode lebih lanjut yang dijalankan
                            }
                        }
                        ?>
                        <!DOCTYPE html>
                        <html lang="id">
                        <head>
                        <style>
                                h2 {
                                    text-align: center;
                                    color: #004080;
                                    margin-top: 5px;
                                }
                                label {
                                    color: #004080;
                                    font-weight: bold;
                                }
                                input, select, button {
                                    width: 100%;
                                    padding: 10px;
                                    margin-top: 8px;
                                    margin-bottom: 16px;
                                    border: 1px solid #cce7ff;
                                    border-radius: 4px;
                                    box-sizing: border-box;
                                }
                                button {
                                    background-color: #004080;
                                    color: #ffffff;
                                    border: none;
                                    cursor: pointer;
                                    font-weight: bold;
                                }
                                button:hover {
                                    background-color: #003366;
                                }
                                form {
                                    margin: 0; /* Mengatur margin form menjadi 0 */
                                    width: 100%; /* Pastikan form memanfaatkan seluruh lebar */
                                    box-sizing: border-box;
                                }
                        </style>
                        </head>
                        <body>
                            <div style="
                                background-color: #ffffff;
                                padding: 20px; 
                                padding-bottom: 30px; 
                                margin: 0; 
                                border-radius: 8px; 
                                width: calc(100% - 0px); 
                                height: 100%;
                                box-sizing:
                                border-box;">
                            <h2>Tambah Data Mahasiswa</h2>
                                <form method="POST" enctype="multipart/form-data">
                                    <label for="nama">Nama:</label>
                                    <input type="text" name="nama" id="nama" required><br><br>

                                    <label for="nim">NIM:</label>
                                    <input type="text" name="nim" id="nim" required><br><br>

                                    <label for="jk">Jenis Kelamin:</label>
                                    <select name="jk" id="jk" required>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select><br><br>

                                    <label for="ttl">Tempat, Tanggal Lahir:</label>
                                    <input type="text" name="ttl" id="ttl" required><br><br>

                                    <label for="alamat">Alamat:</label>
                                    <input type="text" name="alamat" id="alamat" required><br><br>

                                    <label for="email">Email:</label>
                                    <input type="text" name="email" id="email" required><br><br>

                                    <label for="prodi">Prodi:</label>
                                    <select name="prodi" id="prodi" required>
                                        <option value="" disabled selected>Pilih Prodi</option>
                                        <?php foreach ($prodi_options as $prodi): ?>
                                            <option value="<?= htmlspecialchars($prodi) ?>"><?= htmlspecialchars($prodi) ?></option>
                                        <?php endforeach; ?>
                                    </select><br><br>

                                    <label for="kelas">Kelas:</label>
                                    <select name="kelas" id="kelas" required>
                                        <option value="" disabled selected>Pilih Kelas</option>
                                        <?php foreach ($kelas_options as $kelas): ?>
                                            <option value="<?= htmlspecialchars($kelas) ?>"><?= htmlspecialchars($kelas) ?></option>
                                        <?php endforeach; ?>
                                    </select><br><br>

                                    <label for="dpa_id">Pilih DPA:</label>
                                    <select name="dpa_id" id="dpa_id" required>
                                        <option value="" disabled selected>Pilih DPA</option>
                                        <?php foreach ($dpa_options as $dpa): ?>
                                            <option value="<?= htmlspecialchars($dpa['id']) ?>">
                                                <?= htmlspecialchars($dpa['id'] . '. ' . $dpa['nama']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select><br><br>

                                    <label for="foto_mahasiswa">Foto Mahasiswa:</label>
                                    <input type="file" name="foto_mahasiswa" id="foto_mahasiswa" accept="image/*"><br><br>

                                    <button type="submit" name="add-mhs" style="background-color: #004080; color: white; padding: 10px 20px; border: none; border-radius: 5px;">Tambah</button>
                                </form>
                            </div>
                        </body>
                        </html>
                        <?php
                            break;
                        
                    case 'data_dosen':
                        // Query untuk mendapatkan data dosen
                        $query = "SELECT 
                        d.id,
                        d.nama, 
                        d.nidn, 
                        d.jk, 
                        d.alamat, 
                        d.email,
                        d.foto_dosen
                        FROM 
                        dosen d
                        INNER JOIN 
                        akun a 
                        ON 
                        a.dosen_id = d.id";
                        $stmt = sqlsrv_query($conn, $query);

                        // Menyimpan hasil query dalam array
                        $dosen = [];
                        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                        $dosen[] = $row; // Menambahkan setiap data ke array $dosen
                        }

                        include('data_dosen.php');
                        sqlsrv_free_stmt($stmt);
                        break;

                        if (!empty($query_foto)) {
                            $params = array($username);
                            $stmt_foto = sqlsrv_query($conn, $query_foto, $params);
                        
                            if ($stmt_foto === false) {
                                die(print_r(sqlsrv_errors(), true)); // Debugging
                            }
                        }
                        case 'dashboard':
                            ?>
                            <div style="background-color: #ffffff; padding: 20px; padding-bottom: 30px; margin: 0; border-radius: 8px; width: calc(100% - 0px); height: 100%; max-height: 460px; overflow-y: auto; box-sizing: border-box;">
                            <?php
                            if (isset($_SESSION['username']) && isset($_SESSION['role'])) {
                                $username = $_SESSION['username'];
                                $role = $_SESSION['role'];
                        
                                // Tentukan query berdasarkan role
                                $query_foto = "";
                                if ($role == 'dosen' || $role == 'admin') {
                                    $query_foto = "SELECT * FROM dosen WHERE id = (SELECT dosen_id FROM akun WHERE username = ?)";
                                } elseif ($role == 'mahasiswa') {
                                    $query_foto = "SELECT * FROM mahasiswa WHERE id = (SELECT mahasiswa_id FROM akun WHERE username = ?)";
                                }
                        
                                // Eksekusi query hanya jika valid
                                if (!empty($query_foto)) {
                                    $params = array($username);
                                    $stmt_foto = sqlsrv_query($conn, $query_foto, $params);
                        
                                    // Validasi hasil query
                                    if ($stmt_foto === false) {
                                        die(print_r(sqlsrv_errors(), true));
                                    }
                        
                                    // Ambil data jika query berhasil
                                    if (sqlsrv_has_rows($stmt_foto)) {
                                        $foto = sqlsrv_fetch_array($stmt_foto, SQLSRV_FETCH_ASSOC);
                        
                                        // Tampilkan data
                                        echo '<h2>Informasi ' . ucfirst($role) . '</h2>';
                                        echo '<img src="' . htmlspecialchars($foto['foto_dosen'] ?? $foto['foto_mahasiswa'] ?? 'default.png') . '" alt="Foto ' . ucfirst($role) . '" style="width:100px; height:auto;">';

                            // Tampilkan biodata berdasarkan role
                            echo '<table>';
                            if ($role == 'dosen') {
                                echo '<br><tr><td>Nama</td><td>: ' . htmlspecialchars($foto['nama']) . '</td></tr>';
                                echo '<tr><td>NIDN</td><td>: ' . htmlspecialchars($foto['nidn']) . '</td></tr>';
                                echo '<tr><td>Jenis Kelamin</td><td>: ' . htmlspecialchars($foto['jkn']) . '</td></tr>';
                                echo '<tr><td>Alamat</td><td>: ' . htmlspecialchars($foto['alamat']) . '</td></tr>';
                                echo '<tr><td>Email</td><td>: ' . htmlspecialchars($foto['email']) . '</td></tr>';
                            } elseif ($role == 'mahasiswa') {
                                echo '<br><tr><td>Nama</td><td>: ' . htmlspecialchars($foto['nama']) . '</td></tr>';
                                echo '<tr><td>NIM</td><td>: ' . htmlspecialchars($foto['nim']) . '</td></tr>';
                                echo '<tr><td>Jenis Kelamin</td><td>: ' . htmlspecialchars($foto['jk']) . '</td></tr>';
                                echo '<tr><td>Alamat</td><td>: ' . htmlspecialchars($foto['alamat']) . '</td></tr>';
                                echo '<tr><td>Email</td><td>: ' . htmlspecialchars($foto['email']) . '</td></tr>';
                            } elseif ($role == 'admin') {
                                echo '<tr><td>Nama</td><td>: ' . htmlspecialchars($foto['nama']) . '</td></tr>';
                                echo '<tr><td>NIDN</td><td>: ' . htmlspecialchars($foto['nidn']) . '</td></tr>';
                                echo '<tr><td>Jenis Kelamin</td><td>: ' . htmlspecialchars($foto['jk']) . '</td></tr>';
                                echo '<tr><td>Alamat</td><td>: ' . htmlspecialchars($foto['alamat']) . '</td></tr>';
                                echo '<tr><td>Email</td><td>: ' . htmlspecialchars($foto['email']) . '</td></tr>';
                            }
                        }
                            echo '</table></div>';

                        } else {
                            echo '<p>Data tidak ditemukan.</p>';
                        }
                    } else {
                        echo '<p>Query tidak valid.</p>';
                    }
                    
                        break;

                    default:
                        echo '<h2>Halaman tidak ditemukan</h2>';
                        break;
                }
            } else {

            }
            
            ?>
        </div>
    </div>
</body>

</html>

<?php
// Mengakhiri output buffering dan mengirimkan output ke browser
ob_end_flush();
?>