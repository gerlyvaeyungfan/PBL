<?php // Cek apakah pengguna sudah login dan memiliki role 'admin'
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

if (isset($_GET['page']) && $_GET['page'] === 'detail_dosen' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mengambil data detail dosen berdasarkan ID
    $query = "
        SELECT 
        d.nama AS nama_dosen,
        d.nidn,
        d.jk,
        d.alamat,
        d.email,
        d.foto_dosen,
        m.prodi,
        m.kelas,
        m.dpa_id
    FROM dosen d
    LEFT JOIN mahasiswa m ON m.dpa_id = d.id
    WHERE d.id = ?
    ";
    
    $params = array($id);
    $stmt = sqlsrv_query($conn, $query, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $data_dosen = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

    if ($data_dosen) {
        // Tampilkan data detail dosen
        echo '<div style="background-color: #ffffff; padding: 20px; padding-bottom: 30px; margin: 0; border-radius: 8px; width: calc(100% - 0px); height: 100%; box-sizing: border-box;">';
        echo '<h2 style="text-align: left; color: #004080; margin-top: 5px;">Detail Dosen</h2>';
        if (!empty($data_dosen['foto_dosen'])) {
            echo '<p><img src="' . htmlspecialchars($data_dosen['foto_dosen']) . '" alt="Foto Dosen" width="100"></p>';
        } else {
            echo '<p>Foto tidak tersedia</p>';
        }
        echo '<p>Nama: ' . htmlspecialchars($data_dosen['nama_dosen']) . '</p>';
        echo '<p>NIDN: ' . htmlspecialchars($data_dosen['nidn']) . '</p>';
        echo '<p>Jenis Kelamin: ' . htmlspecialchars($data_dosen['jk']) . '</p>';
        echo '<p>Alamat: ' . htmlspecialchars($data_dosen['alamat']) . '</p>';
        echo '<p>Email: ' . htmlspecialchars($data_dosen['email']) . '</p>';

        // Mengambil data mahasiswa yang dibimbing
        $program_studi_kelas = [];
        while ($data_mahasiswa = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            // Hanya tambahkan program studi dan kelas jika belum ada dalam array
            $program_studi_kelas[] = [
                'prodi' => $data_mahasiswa['prodi'],
                'kelas' => $data_mahasiswa['kelas']
            ];
        }

        // Menghapus duplikat dengan array_unique
        $program_studi_kelas = array_map("unserialize", array_unique(array_map("serialize", $program_studi_kelas)));

        if (!empty($program_studi_kelas)) {
            echo '<p><strong>Program Studi dan Kelas yang Dibimbing:</strong></p>';
            echo '<ul>';
            foreach ($program_studi_kelas as $data) {
                echo '<li>Prodi: ' . htmlspecialchars($data['prodi']) . ' - Kelas: ' . htmlspecialchars($data['kelas']) . '</li>';
            }
            echo '</ul>';
        } else {
            echo '';
        }
    } else {
        echo '<p>Data dosen tidak ditemukan.</p>';
    }
}
?>