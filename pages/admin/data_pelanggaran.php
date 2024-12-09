
<div style="background-color: #ffffff; padding: 20px; padding-bottom: 30px; margin: 0; border-radius: 8px; width: calc(100% - 0px); height: 100%; max-height: 460px; overflow-y: auto; box-sizing: border-box;">
<?php
// Variabel untuk menampilkan data pelanggaran
$prodi = isset($_GET['prodi']) ? $_GET['prodi'] : '';
$kelas = isset($_GET['kelas']) ? $_GET['kelas'] : '';

// Form untuk memilih prodi dan kelas
echo '
<div class="form">
    <form method="GET" action="">
        <input type="hidden" name="page" value="pelanggaran">
        
        <label for="prodi">Pilih Prodi</label>
        <select id="prodi" name="prodi">
            <option value="" selected>Pilih Prodi (semua)</option>
            <option value="TI" ' . ($prodi == 'TI' ? 'selected' : '') . '>TI</option>
            <option value="SIB" ' . ($prodi == 'SIB' ? 'selected' : '') . '>SIB</option>
            <option value="PPLS" ' . ($prodi == 'PPLS' ? 'selected' : '') . '>PPLS</option>
        </select>
        <br><br> <!-- Pemisah antara form dan tabel -->
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
        <br><br> <!-- Pemisah antara form dan tombol -->
        <button type="submit" class="save">Tampilkan Laporan</button>
    </form>
</div>';

// Query untuk menampilkan laporan sesuai dengan kondisi yang dipilih
if ($prodi && $kelas) {
    // Jika Prodi dan Kelas dipilih, tampilkan laporan sesuai filter
    $query_laporan = "
        SELECT 
            l.id AS laporan_id,
            l.tgl_laporan AS tanggal_laporan,
            d_dosen.nama AS nama_dosen,
            m.nama AS nama_mahasiswa,
            m.prodi,
            m.kelas,
            p.deskripsi AS deskripsi_pelanggaran,
            p.tingkat_pelanggaran,
            d_dpa.nama AS nama_dpa
        FROM laporan l
        INNER JOIN mahasiswa m ON l.mhs_id = m.id
        INNER JOIN dosen d_dpa ON m.dpa_id = d_dpa.id
        INNER JOIN dosen d_dosen ON l.dosen_id = d_dosen.id
        INNER JOIN pelanggaran p ON l.pelanggaran_id = p.id
        WHERE m.prodi = ? AND m.kelas = ?
        ORDER BY tanggal_laporan DESC;
    ";
    // Menyiapkan parameter
    $params = [$prodi, $kelas];
} elseif ($prodi) {
    // Jika hanya Prodi yang dipilih, tampilkan seluruh laporan untuk Prodi tersebut
    $query_laporan = "
        SELECT 
            l.id AS laporan_id,
            l.tgl_laporan AS tanggal_laporan,
            d_dosen.nama AS nama_dosen,
            m.nama AS nama_mahasiswa,
            m.prodi,
            m.kelas,
            p.deskripsi AS deskripsi_pelanggaran,
            p.tingkat_pelanggaran,
            d_dpa.nama AS nama_dpa
        FROM laporan l
        INNER JOIN mahasiswa m ON l.mhs_id = m.id
        INNER JOIN dosen d_dpa ON m.dpa_id = d_dpa.id
        INNER JOIN dosen d_dosen ON l.dosen_id = d_dosen.id
        INNER JOIN pelanggaran p ON l.pelanggaran_id = p.id
        WHERE m.prodi = ?
        ORDER BY tanggal_laporan DESC;
    ";
    // Menyiapkan parameter
    $params = [$prodi];
} elseif ($kelas) {
    // Jika hanya Kelas yang dipilih, tampilkan seluruh laporan untuk Kelas tersebut
    $query_laporan = "
        SELECT 
            l.id AS laporan_id,
            l.tgl_laporan AS tanggal_laporan,
            d_dosen.nama AS nama_dosen,
            m.nama AS nama_mahasiswa,
            m.prodi,
            m.kelas,
            p.deskripsi AS deskripsi_pelanggaran,
            p.tingkat_pelanggaran,
            d_dpa.nama AS nama_dpa
        FROM laporan l
        INNER JOIN mahasiswa m ON l.mhs_id = m.id
        INNER JOIN dosen d_dpa ON m.dpa_id = d_dpa.id
        INNER JOIN dosen d_dosen ON l.dosen_id = d_dosen.id
        INNER JOIN pelanggaran p ON l.pelanggaran_id = p.id
        WHERE m.kelas = ?
        ORDER BY tanggal_laporan DESC;
    ";
    // Menyiapkan parameter
    $params = [$kelas];
} else {
    // Jika tidak ada filter, tampilkan seluruh data pelanggaran
    $query_laporan = "
        SELECT 
            l.id AS laporan_id,
            l.tgl_laporan AS tanggal_laporan,
            d_dosen.nama AS nama_dosen,
            m.nama AS nama_mahasiswa,
            m.prodi,
            m.kelas,
            p.deskripsi AS deskripsi_pelanggaran,
            p.tingkat_pelanggaran,
            d_dpa.nama AS nama_dpa
        FROM laporan l
        INNER JOIN mahasiswa m ON l.mhs_id = m.id
        INNER JOIN dosen d_dpa ON m.dpa_id = d_dpa.id
        INNER JOIN dosen d_dosen ON l.dosen_id = d_dosen.id
        INNER JOIN pelanggaran p ON l.pelanggaran_id = p.id
        ORDER BY tanggal_laporan DESC;
    ";
    // Tidak ada parameter karena seluruh data akan ditampilkan
    $params = [];
}

// Menyiapkan statement
$stmt_laporan = sqlsrv_prepare($conn, $query_laporan, $params);

if ($stmt_laporan === false) {
    die(print_r(sqlsrv_errors(), true)); // Tampilkan error jika terjadi kesalahan
}

// Eksekusi statement
if (sqlsrv_execute($stmt_laporan)) {
    if (sqlsrv_has_rows($stmt_laporan)) {
        echo '<h3>Hasil Laporan</h3>';
        if ($prodi && $kelas) {
            echo '<p>Prodi: ' . htmlspecialchars($prodi) . '</p>';
            echo '<p>Kelas: ' . htmlspecialchars($kelas) . '</p>';
        } elseif ($prodi) {
            echo '<p>Prodi: ' . htmlspecialchars($prodi) . '</p>';
        } elseif ($kelas) {
            echo '<p>Kelas: ' . htmlspecialchars($kelas) . '</p>';
        } else {
            echo '<p>Menampilkan seluruh data pelanggaran.</p>';
        }

        echo '<table border="1" cellpadding="10" cellspacing="0" style="margin: 0px 0px">';
        echo '<tr style="background-color: blue; color: white; padding: 5px 5px;">
                <th>ID Laporan</th>
                <th>Tanggal Pelanggaran</th>
                <th>Nama Dosen</th>
                <th>Nama Mahasiswa</th>
                <th>Prodi</th>
                <th>Kelas</th>
                <th>Deskripsi</th>
                <th>Tingkat</th>
                <th>Nama DPA</th>
            </tr>';

        while ($row = sqlsrv_fetch_array($stmt_laporan, SQLSRV_FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['laporan_id']) . '</td>';
            echo '<td>' . htmlspecialchars($row['tanggal_laporan']->format('Y-m-d')) . '</td>'; // Format tanggal
            echo '<td>' . htmlspecialchars($row['nama_dosen']) . '</td>';
            echo '<td>' . htmlspecialchars($row['nama_mahasiswa']) . '</td>';
            echo '<td>' . htmlspecialchars($row['prodi']) . '</td>';
            echo '<td>' . htmlspecialchars($row['kelas']) . '</td>';
            echo '<td>' . htmlspecialchars($row['deskripsi_pelanggaran']) . '</td>';
            echo '<td>' . htmlspecialchars($row['tingkat_pelanggaran']) . '</td>';
            echo '<td>' . htmlspecialchars($row['nama_dpa']) . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo '<p>No records found for the selected filter(s).</p>';
    }
} else {
    echo "Error executing query.";
}
?>
</div>