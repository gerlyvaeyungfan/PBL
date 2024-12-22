<?php
require_once('../../controller/lib/Connection.php'); // Pastikan koneksi database tersedia

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'mahasiswa') {
    header('Location: login.php');
    exit;
}

if (isset($_SESSION['mahasiswa_id'])) {
    $mahasiswa_id = intval($_SESSION['mahasiswa_id']);
}

// Inisialisasi variabel
$status_message = "";
$deskripsi_pelanggaran = "";
$tingkat_sanksi = "";  // Mengubah nama variabel sesuai dengan query
$deskripsi_sanksi = "";

// Ambil id_laporan dari GET
if (isset($_GET['id_laporan'])) {
    $id_laporan = intval($_GET['id_laporan']);

    // Query untuk mengambil detail laporan berdasarkan id_laporan
    $sql = "
        EXEC sp_get_detail_laporan @id_laporan = ?
    ";
    $stmt = sqlsrv_query($conn, $sql, [$id_laporan]);

    if ($stmt === false) {
        $status_message = "Error retrieving data: " . print_r(sqlsrv_errors(), true);
    } else {
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        if ($row) {
            $deskripsi_pelanggaran = $row['deskripsi_pelanggaran'];
            $tingkat_sanksi = $row['tingkat_sanksi'];
            $deskripsi_sanksi = $row['deskripsi_sanksi'] ?? "";
            $foto_pelanggaran = $row['foto_pelanggaran'] ?? "";
        } else {
            $status_message = "Data laporan tidak ditemukan untuk ID: $id_laporan";
        }
    }
} else {
    $status_message = "ID laporan tidak valid.";
}

// Proses upload file jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    if (!empty($deskripsi_pelanggaran)) {
        $target_dir = "../../view/img/sanksi/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (!in_array($fileType, ['pdf', 'docx', 'jpg', 'png'])) {
            $status_message = "Hanya file PDF, DOCX, JPG, PNG yang diperbolehkan.";
            $uploadOk = 0;
        }

        if ($_FILES["file"]["size"] > 5000000) {
            $status_message = "File terlalu besar (maksimal 5MB).";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                $sql_update = "UPDATE laporan SET file_sanksi = ? WHERE id = ?";
                $stmt_update = sqlsrv_prepare($conn, $sql_update, [$target_file, $id_laporan]);

                if ($stmt_update && sqlsrv_execute($stmt_update)) {
                    $status_message = "File berhasil diupload dan disimpan.";
                } else {
                    $status_message = "Gagal menyimpan file: " . print_r(sqlsrv_errors(), true);
                }
            } else {
                $status_message = "Gagal mengupload file.";
            }
        }
    } else {
        $status_message = "Tidak ada data pelanggaran yang ditemukan untuk ID laporan ini.";
    }
}
?>
<?php include('../navbar.php');?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Bukti Sanksi</title>
    <style>
        .alert { padding: 15px; margin-bottom: 20px; border-radius: 5px; font-size: 16px; }
        .alert.success { background-color: #d4edda; color: #155724; }
        .alert.error { background-color: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
<div style="background-color: #ffffff; padding: 20px; border-radius: 8px;">

    <h2>Form Upload Bukti Sanksi</h2>

    <?php if ($status_message): ?>
        <div class="alert <?php echo strpos($status_message, 'Error') !== false ? 'error' : 'success'; ?>">
            <?php echo $status_message; ?>
        </div>
    <?php endif; ?>

    <!-- Tampilkan detail laporan -->
    <?php if (!empty($deskripsi_pelanggaran)): ?>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <p><strong>Deskripsi Pelanggaran:</strong> <?php echo htmlspecialchars($deskripsi_pelanggaran); ?></p>
                <p><strong>Tingkat Sanksi:</strong> <?php echo htmlspecialchars($tingkat_sanksi); ?></p>
                <p><strong>Deskripsi Sanksi:</strong> <?php echo htmlspecialchars($deskripsi_sanksi); ?></p>
                <p><strong>Foto Pelanggaran:</strong></p>
                <?php if (!empty($foto_pelanggaran)): ?>
                    <img src="<?php echo htmlspecialchars($foto_pelanggaran); ?>" alt="Foto Pelanggaran" style="max-width: 100px; height: auto; border: 1px solid #ddd; border-radius: 5px;">
                <?php else: ?>
                    <p>Tidak ada foto pelanggaran tersedia.</p>
                <?php endif; ?>
                <br><br>
                <label for="file">Upload File Sanksi</label>
                <input type="file" id="file" name="file" accept=".pdf,.docx,.jpg,.png" required>
            </div>
            <div class="form-actions">
                <button type="submit" name="submit">Upload</button>
            </div>
        </form>
    <?php else: ?>
        <p>ID laporan tidak valid atau data tidak ditemukan.</p>
    <?php endif; ?>
</div>
</body>
</html>