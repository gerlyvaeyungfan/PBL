<?php
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
?>
<div style="background-color: #ffffff; padding: 20px; padding-bottom: 30px; margin: 0; border-radius: 8px; width: calc(100% - 0px); height: 100%; box-sizing: border-box;">
    
    <?php
    // Variabel untuk menampilkan data pelanggaran
    $prodi = isset($_GET['prodi']) ? $_GET['prodi'] : '';
    $kelas = isset($_GET['kelas']) ? $_GET['kelas'] : '';

    // Form untuk memilih prodi dan kelas
    echo '
<div class="form">
    <form method="GET" action="">
        <input type="hidden" name="page" value="pelanggaran">
        
        <div style="display: flex; justify-content: space-between; gap: 20px;">
            <div style="flex: 1;">
                <label for="prodi">Pilih Prodi</label>
                <select id="prodi" name="prodi">
                    <option value="" selected>Pilih Prodi (semua)</option>
                    <option value="TI" ' . ($prodi == 'TI' ? 'selected' : '') . '>TI</option>
                    <option value="SIB" ' . ($prodi == 'SIB' ? 'selected' : '') . '>SIB</option>
                    <option value="PPLS" ' . ($prodi == 'PPLS' ? 'selected' : '') . '>PPLS</option>
                </select>
            </div>

            <div style="flex: 1;">
                <label for="kelas">Pilih Kelas</label>
                <select id="kelas" name="kelas">
                    <option value="" selected>Pilih Kelas (semua)</option>
                    <option value="1A" ' . ($kelas == '1A' ? 'selected' : '') . '>1A</option>
                    <option value="1B" ' . ($kelas == '1B' ? 'selected' : '') . '>1B</option>
                    <option value="2A" ' . ($kelas == '2A' ? 'selected' : '') . '>2A</option>
                    <option value="2B" ' . ($kelas == '2B' ? 'selected' : '') . '>2B</option>
                    <option value="3A" ' . ($kelas == '3A' ? 'selected' : '') . '>3A</option>
                    <option value="3B" ' . ($kelas == '3B' ? 'selected' : '') . '>3B</option>
                    <option value="4A" ' . ($kelas == '4A' ? 'selected' : '') . '>4A</option>
                    <option value="4B" ' . ($kelas == '4B' ? 'selected' : '') . '>4B</option>
                </select>
            </div>
        </div><!-- Pemisah antara form dan tombol -->
        <button type="submit" class="save">Tampilkan Laporan</button>
    </form>
</div>';

    // Query untuk menampilkan laporan sesuai dengan kondisi yang dipilih
    // Menggunakan stored procedure untuk mengambil data berdasarkan filter prodi dan kelas
    $query_laporan = "
    EXEC sp_get_pelanggaran_mahasiswa @prodi = ?, @kelas = ?;
";

    // Menyiapkan parameter yang akan diberikan ke stored procedure
    // Jika prodi atau kelas kosong, berikan NULL agar prosedur menampilkan semua data
    $params = [
        $prodi ?: NULL, // Jika $prodi kosong, masukkan NULL
        $kelas ?: NULL  // Jika $kelas kosong, masukkan NULL
    ];

    // Menyiapkan statement
    $stmt_laporan = sqlsrv_prepare($conn, $query_laporan, $params);

    if ($stmt_laporan === false) {
        die(print_r(sqlsrv_errors(), true)); // Tampilkan error jika terjadi kesalahan
    }

    // Eksekusi statement
    if (sqlsrv_execute($stmt_laporan)) {
        if (sqlsrv_has_rows($stmt_laporan)) {
            echo '<h3>Data Pelanggaran Mahasiswa</h3>';
            if ($prodi && $kelas) {
                echo '<p>Prodi: ' . htmlspecialchars($prodi) . '</p>';
                echo '<p>Kelas: ' . htmlspecialchars($kelas) . '</p>';
            } elseif ($prodi) {
                echo '<p>Prodi: ' . htmlspecialchars($prodi) . '</p>';
            } elseif ($kelas) {
                echo '<p>Kelas: ' . htmlspecialchars($kelas) . '</p>';
            }
            echo '<table border="1" cellpadding="5" cellspacing="0" style="width: 100%; margin: 0px 0px;">';
            echo '<tr style="background-color: #004080; color: white; font-size: 14px;">
                <th>No</th>
                <th style="width: 70px;">Tanggal</th>
                <th>Nama Pelapor</th>
                <th>Nama Mahasiswa</th>
                <th>Kelas</th>
                <th>Pelanggaran</th>
                <th>Tingkat</th>
                <th>Sanksi</th>
                <th>Nama DPA</th>
            </tr>';
            $no = 1; // Inisialisasi nomor urut
            while ($row = sqlsrv_fetch_array($stmt_laporan, SQLSRV_FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td style="text-align: center;">' . $no . '</td>'; // Menampilkan nomor urut
                echo '<td style="font-size: 12px; text-align:center;">' . htmlspecialchars($row['tanggal_laporan']->format('Y-m-d')) . '</td>'; // Format tanggal
                echo '<td style="font-size: 12px;">' . htmlspecialchars($row['nama_dosen']) . '</td>';
                echo '<td style="font-size: 12px;">' . htmlspecialchars($row['nama_mahasiswa']) . '</td>';
                echo '<td style="font-size: 12px; text-align:center;">' . htmlspecialchars($row['prodi']) . '-'. htmlspecialchars($row['kelas']) .'</td>';
                // Modifikasi kolom pelanggaran
                $deskripsi = htmlspecialchars($row['deskripsi']);
                $deskripsi_pendek = strlen($deskripsi) > 50 ? substr($deskripsi, 0, 50) . '...' : $deskripsi;
                echo '<td style="font-size: 12px;">' . $deskripsi_pendek . '</td>';
                echo '<td style="font-size: 12px; text-align:center;">' . htmlspecialchars($row['tingkat_sanksi']) . '</td>';
                echo '<td style="font-size: 12px;">' . htmlspecialchars($row['deskripsi_sanksi']) . '</td>';
                echo '<td style="font-size: 12px;">' . htmlspecialchars($row['nama_dpa']) . '</td>';
                echo '</tr>';
                
                $no++; // Increment nomor urut
            }

            echo '</table>';
        } else {
            echo '<p>Tidak ada Data Pelanggaran.</p>';
        }
    } else {
        echo "Error executing query.";
    }
    ?>
</div>