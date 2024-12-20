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
if (isset($_GET['page']) && $_GET['page'] === 'edit_mahasiswa' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mendapatkan data mahasiswa berdasarkan ID
    $query = "
        SELECT 
            nama, 
            nim, 
            jk, 
            prodi, 
            kelas, 
            foto_mahasiswa, 
            dpa_id
        FROM mahasiswa
        WHERE id = ?";
    $params = array($id);
    $stmt = sqlsrv_query($conn, $query, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $data_mhs = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Mendapatkan data dari form
        $nama = $_POST['nama'];
        $nim = $_POST['nim'];
        $jk = $_POST['jk'];
        $prodi = $_POST['prodi'];
        $kelas = $_POST['kelas'];
        $dpa_id = $_POST['dpa_id'];
        
        // Memeriksa apakah ada foto baru yang diupload
        if (isset($_FILES['foto_mahasiswa']) && $_FILES['foto_mahasiswa']['error'] === UPLOAD_ERR_OK) {
            $file_tmp = $_FILES['foto_mahasiswa']['tmp_name'];
            $file_name = $_FILES['foto_mahasiswa']['name'];
            $file_size = $_FILES['foto_mahasiswa']['size'];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

            // Menentukan direktori penyimpanan file
            $upload_dir = '../../view/img/mahasiswa/';
            $new_file_name = $upload_dir . $file_name; // Menggunakan nama asli file yang diupload

            // Validasi ekstensi file (hanya gambar)
            $allowed_extensions = array('jpg', 'jpeg', 'png');
            if (in_array(strtolower($file_ext), $allowed_extensions)) {
                // Pindahkan file ke folder tujuan
                move_uploaded_file($file_tmp, $new_file_name);

                // Menyimpan nama file foto baru ke database
                $foto_mahasiswa = $new_file_name;
            } else {
                $foto_mahasiswa = $data_mhs['foto_mahasiswa']; // Jika ekstensi tidak valid, tetap gunakan foto lama
            }
        } else {
            $foto_mahasiswa = $data_mhs['foto_mahasiswa']; // Jika tidak ada foto baru, tetap gunakan foto lama
        }

        // Query untuk update data mahasiswa
        $update_query = "
            UPDATE mahasiswa
            SET nama = ?, nim = ?, jk = ?, prodi = ?, kelas = ?, dpa_id = ?, foto_mahasiswa = ?
            WHERE id = ?";
        $update_params = array($nama, $nim, $jk, $prodi, $kelas, $dpa_id, $foto_mahasiswa, $id);

        $update_stmt = sqlsrv_query($conn, $update_query, $update_params);

        if ($update_stmt) {
            echo '<p>Data berhasil diperbarui.</p>';
            header('Location: admin_dashboard.php?page=detail_mahasiswa&id=' . urlencode($id));
            exit;
        } else {
            echo '<p>Terjadi kesalahan saat memperbarui data.</p>';
        }
    }

    if ($data_mhs) {
        // Menambahkan tag <style> untuk styling CSS
        echo '<style>
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
                    font-weight: bold;
                    cursor: pointer;
                }
                .button-yellow {
                    background-color: #ffcc00;
                    color: #ffffff;
                    border: none;
                }
                .button-yellow:hover {
                    background-color: #e6b800;
                }
                .button-red {
                    background-color: #ff3333;
                    color: #ffffff;
                    border: none;
                }
                .button-red:hover {
                    background-color: #e60000;
                }
                form {
                    margin: 0;
                    width: 100%;
                    box-sizing: border-box;
                }
              </style>';

        // Form untuk edit data mahasiswa
        echo '<div style="background-color:#ffffff; padding: 20px; padding-bottom: 30px; margin: 0; border-radius: 8px; width: 100%; height: 100%; box-sizing: border-box;">';
        echo '<h2>Edit Mahasiswa</h2>';
        echo '<form method="POST" enctype="multipart/form-data">';  // Menambahkan enctype untuk upload file
        echo '<label>Nama:</label><br><input type="text" name="nama" value="' . htmlspecialchars($data_mhs['nama']) . '"><br>';
        echo '<label>NIM:</label><br><input type="text" name="nim" value="' . htmlspecialchars($data_mhs['nim']) . '"><br>';
        echo '<label>Jenis Kelamin:</label><br><input type="text" name="jk" value="' . htmlspecialchars($data_mhs['jk']) . '"><br>';
        echo '<label>Prodi:</label><br><input type="text" name="prodi" value="' . htmlspecialchars($data_mhs['prodi']) . '"><br>';
        echo '<label>Kelas:</label><br><input type="text" name="kelas" value="' . htmlspecialchars($data_mhs['kelas']) . '"><br>';
        echo '<label>DPA ID:</label><br><input type="text" name="dpa_id" value="' . htmlspecialchars($data_mhs['dpa_id']) . '"><br>';
        
        // Menampilkan foto mahasiswa lama dan form upload foto baru
        echo '<label>Foto Mahasiswa:</label><br>';
        if (!empty($data_mhs['foto_mahasiswa'])) {
            echo '<img src="' . htmlspecialchars($data_mhs['foto_mahasiswa']) . '" alt="Foto Mahasiswa" width="100"><br>';
        } else {
            echo '<p>Tidak ada foto.</p>';
        }
        echo '<input type="file" name="foto_mahasiswa"><br>';
        
        echo '<button type="submit" class="button-yellow">Simpan</button>';
        echo '</form>';

        echo '</div>';
    } else {
        echo '<p>Data mahasiswa tidak ditemukan.</p>';
    }
}
?>
