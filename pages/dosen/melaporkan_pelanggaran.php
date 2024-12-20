<?php
ob_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'dosen') {
    header('Location: dosen_dashboard.php');
    exit;
}

if (!isset($_SESSION['dosen_id']) || empty($_SESSION['dosen_id'])) {
    header('Location: dosen_dashboard.php');
    die("Session ID tidak ditemukan. Pastikan dosen sudah login."); 
}

require_once('../../controller/lib/Connection.php'); // Pastikan koneksi database tersedia

$prodi = isset($_GET['prodi']) ? $_GET['prodi'] : '';
$kelas = isset($_GET['kelas']) ? $_GET['kelas'] : '';

if (isset($_SESSION['dosen_id'])) {
    $dosen_id = intval($_SESSION['dosen_id']);
    }

// Query mahasiswa dengan filter berdasarkan Prodi dan Kelas
$mahasiswa_list = [];
$sql_mahasiswa = "
    SELECT m.id AS mahasiswa_id, m.nama AS mahasiswa_nama, a.username 
    FROM akun a
    JOIN mahasiswa m ON a.mahasiswa_id = m.id
    WHERE a.role = 'mahasiswa'
";
$params = [];

if (!empty($prodi)) {
    $sql_mahasiswa .= " AND m.prodi = ?";
    $params[] = $prodi;
}

if (!empty($kelas)) {
    $sql_mahasiswa .= " AND m.kelas = ?";
    $params[] = $kelas;
}

$stmt_mahasiswa = sqlsrv_query($conn, $sql_mahasiswa, $params);
// Eksekusi query

// Cek apakah query berhasil
if ($stmt_mahasiswa === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Ambil data mahasiswa
while ($row = sqlsrv_fetch_array($stmt_mahasiswa, SQLSRV_FETCH_ASSOC)) {
    $mahasiswa_list[] = $row;
}

$pelanggaran_list = [];
$sql_pelanggaran = "SELECT id, deskripsi FROM pelanggaran";

$stmt_pelanggaran = sqlsrv_query($conn, $sql_pelanggaran);

// Cek apakah query berhasil
if ($stmt_pelanggaran === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Ambil data pelanggaran dari hasil query
while ($row = sqlsrv_fetch_array($stmt_pelanggaran, SQLSRV_FETCH_ASSOC)) {
    $pelanggaran_list[] = $row;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pelanggaran_id = isset($_POST['pelanggaran_id']) ? $_POST['pelanggaran_id'] : null;
    // Ambil ID dosen dari session login
    $dosen_id = intval($_SESSION['dosen_id']); // Konversi ke integer

    // Data lain dari form
    $mhs_id = $_POST['mhs_id'];
    $tgl_laporan = $_POST['tanggal'];
    $pelanggaran_id = $_POST['pelanggaran_id'];
    $foto_pelanggaran = ''; // Proses upload foto
    $status_verifikasi = 0; // Default status belum diverifikasi
    $file_sanksi = ''; // File sanksi jika ada
    $dpa_id = null; // DPA ID akan diambil berdasarkan mhs_id

    if (empty($pelanggaran_id)) {
        die("Pelanggaran belum dipilih. Silakan pilih pelanggaran.");
    }

    // Ambil tingkat sanksi berdasarkan pelanggaran_id
    $sql_tingkat = "SELECT tingkat_sanksi FROM pelanggaran WHERE id = ?";
    $stmt_tingkat = sqlsrv_query($conn, $sql_tingkat, [$pelanggaran_id]);

    if ($stmt_tingkat === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $row_tingkat = sqlsrv_fetch_array($stmt_tingkat, SQLSRV_FETCH_ASSOC);
    $tingkat_sanksi = $row_tingkat ? $row_tingkat['tingkat_sanksi'] : null;

    if (is_null($tingkat_sanksi)) {
        die("Tingkat sanksi tidak ditemukan untuk pelanggaran yang dipilih.");
    }

    // Ambil dpa_id dari tabel mahasiswa berdasarkan mhs_id yang dipilih
    $sql_dpa_id = "SELECT dpa_id FROM mahasiswa WHERE id = ?";
    $stmt_dpa_id = sqlsrv_query($conn, $sql_dpa_id, [$mhs_id]);

    if ($stmt_dpa_id === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $row_dpa = sqlsrv_fetch_array($stmt_dpa_id, SQLSRV_FETCH_ASSOC);
    $dpa_id = $row_dpa ? $row_dpa['dpa_id'] : null;

    // Upload file foto pelanggaran jika ada
    if (isset($_FILES['files']) && $_FILES['files']['error'][0] == 0) {
        $target_dir = "../../view/img/sanksi/";
        $target_file = $target_dir . basename($_FILES["files"]["name"][0]);
        move_uploaded_file($_FILES["files"]["tmp_name"][0], $target_file);
        $foto_pelanggaran = $target_file;
    }

    // Query untuk memasukkan data laporan
    $sql_insert_laporan = "
        INSERT INTO laporan (dosen_id, mhs_id, tgl_laporan, pelanggaran_id, foto_pelanggaran, tingkat_sanksi, status_verifikasi, file_sanksi, dpa_id)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ";
    $params_insert = array($dosen_id, $mhs_id, $tgl_laporan, $pelanggaran_id, $foto_pelanggaran, $tingkat_sanksi, $status_verifikasi, $file_sanksi, $dpa_id);
    $stmt_insert = sqlsrv_query($conn, $sql_insert_laporan, $params_insert);

    // Cek apakah query insert berhasil
    if ($stmt_insert === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        echo "Laporan berhasil ditambahkan!";
    }
}
ob_end_clean();

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TATIB Dashboard</title>
    <link rel="stylesheet" href="../../view/style/Dosencss.css">
</head>
<body>
    <?php include('../navbar.php'); ?>
    <?php include('sidebar_dosen.php'); ?>

    <div style="background-color: #ffffff; padding: 20px; border-radius: 8px;">

    <h2>Form Pelaporan Pelanggaran Mahasiswa</h2>
        <!-- Form Pilih Prodi dan Kelas -->
        <form id="laporanForm" method="POST" action="" enctype="multipart/form-data">
            <label for="prodi">Pilih Prodi</label>
            <select id="prodi" name="prodi">
                <option value="" selected>Pilih Prodi (semua)</option>
                <option value="TI" <?php if ($prodi == 'TI') echo 'selected'; ?>>TI</option>
                <option value="SIB" <?php if ($prodi == 'SIB') echo 'selected'; ?>>SIB</option>
                <option value="PPLS" <?php if ($prodi == 'PPLS') echo 'selected'; ?>>PPLS</option>
            </select>
            <br><br>

            <label for="kelas">Pilih Kelas</label>
            <select id="kelas" name="kelas">
                <option value="" selected>Pilih Kelas (semua)</option>
                <option value="1A" <?php if ($kelas == '1A') echo 'selected'; ?>>1A</option>
                <option value="1B" <?php if ($kelas == '1B') echo 'selected'; ?>>1B</option>
                <option value="2A" <?php if ($kelas == '2A') echo 'selected'; ?>>2A</option>
                <option value="2B" <?php if ($kelas == '2B') echo 'selected'; ?>>2B</option>
                <option value="3A" <?php if ($kelas == '3A') echo 'selected'; ?>>3A</option>
                <option value="3B" <?php if ($kelas == '3B') echo 'selected'; ?>>3B</option>
                <option value="4A" <?php if ($kelas == '4A') echo 'selected'; ?>>4A</option>
                <option value="4B" <?php if ($kelas == '4B') echo 'selected'; ?>>4B</option>
            </select>
            <br><br> 

            <label for="mhs_id">Pilih Nama Mahasiswa</label>
            <select id="mhs_id" name="mhs_id">
                <option value="">Pilih Nama Mahasiswa</option>
                <?php
                if (!empty($mahasiswa_list)) {
                    foreach ($mahasiswa_list as $mahasiswa) {
                        echo '<option value="' . $mahasiswa['mahasiswa_id'] . '">' . htmlspecialchars($mahasiswa['mahasiswa_nama']) . '</option>';
                    }
                } else {
                    echo '<option value="">Tidak ada mahasiswa ditemukan</option>';
                }
                ?>
            </select>
            <br><br> 

            <label for="tanggal">Tanggal</label>
            <input type="date" id="tanggal" name="tanggal" placeholder="Tanggal">
            <br><br> 

            <label for="pelanggaran">Pelanggaran</label>
            <select id="pelanggaran" name="pelanggaran" onchange="setPelanggaranId()">
                <option value="">Pilih Pelanggaran</option>
                <?php
                if (!empty($pelanggaran_list)) {
                    foreach ($pelanggaran_list as $pelanggaran) {
                        echo '<option value="' . $pelanggaran['id'] . '">' . $pelanggaran['deskripsi'] . '</option>';
                    }
                } else {
                    echo '<option value="">Tidak ada pelanggaran ditemukan</option>';
                }
                ?>
            </select>
            <input type="hidden" id="pelanggaran_id" name="pelanggaran_id"/>
            <br><br>


            <label for="bukti">Bukti Foto</label>
            <input type="file" name="files[]" multiple="multiple" accept=".jpg, .jpeg, .png" />
            <br><br>

            <button type="submit" class="save">Laporkan Pelanggaran</button>
        </form>

        <script>
        function setPelanggaranId() {
            const pelanggaranSelect = document.getElementById('pelanggaran');
            const pelanggaranIdInput = document.getElementById('pelanggaran_id');
            pelanggaranIdInput.value = pelanggaranSelect.value;
        }

        // Update data mahasiswa berdasarkan perubahan Prodi atau Kelas
        document.getElementById('prodi').addEventListener('change', function() {
            updateURL();
        });

        document.getElementById('kelas').addEventListener('change', function() {
            updateURL();
        });

        function updateURL() {
            var prodi = document.getElementById('prodi').value;
            var kelas = document.getElementById('kelas').value;
            var url = new URL(window.location.href);

            if (prodi) {
                url.searchParams.set('prodi', prodi);
            } else {
                url.searchParams.delete('prodi');
            }

            if (kelas) {
                url.searchParams.set('kelas', kelas);
            } else {
                url.searchParams.delete('kelas');
            }

            // Reload halaman dengan parameter baru
            window.location.href = url.toString();
        }
    </script>

    </div>
</body>
</html>