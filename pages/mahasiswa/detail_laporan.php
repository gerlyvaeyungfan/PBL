<?php

ob_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'mahasiswa') {
    header('Location: mahasiswa_dashboard.php');
    exit;
}

if (!isset($_SESSION['mahasiswa_id']) || empty($_SESSION['mahasiswa_id'])) {
    header('Location: mahasiswa_dashboard.php');
    die("Session ID tidak ditemukan. Pastikan dosen sudah login.");
}

require_once('../../controller/lib/Connection.php'); // Pastikan koneksi database tersedia

if (isset($_SESSION['mahasiswa_id'])) {
    $mahasiswan_id = intval($_SESSION['mahasiswa_id']);
    }
    
if (isset($_GET['id_laporan']) && !empty($_GET['id_laporan'])) {
    $laporan_id = intval($_GET['id_laporan']);

    // Query untuk mendapatkan detail laporan
    $query_detail = "EXEC sp_get_detail_laporan @id_laporan = ?;";
    $params_detail = [$laporan_id];
    $stmt_detail = sqlsrv_prepare($conn, $query_detail, $params_detail);

    if ($stmt_detail === false) {
        die(print_r(sqlsrv_errors(), true)); // Tampilkan error jika terjadi kesalahan
    }

    $laporan_detail = [];
    if (sqlsrv_execute($stmt_detail)) {
        $laporan_detail = sqlsrv_fetch_array($stmt_detail, SQLSRV_FETCH_ASSOC);
    } else {
        die("Error executing query.");
    }

    // Pastikan data ditemukan, jika tidak tampilkan pesan error
    if (empty($laporan_detail)) {
        die("Laporan tidak ditemukan.");
    }
} else {
    die("ID Laporan tidak valid.");
}

ob_end_clean();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pelanggaran Mahasiswa</title>
    <style>
        .btn-back {
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 5px;
            justify-items: center   ;
            font-size: 14px;
        }

        .btn-back:hover {
            background-color: #45a049;
        }

        .detail-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            justify-items: center;
        }

        .detail-container h2 {
            margin-bottom: 20px;
        }

        .detail-container p {
            margin: 8px 0;
            font-size: 14px;
        }

        .label {
            font-weight: bold;
        }

        .detail-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .detail-table th, .detail-table td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .detail-table th {
            background-color: #004080;
            color: white;
        }

        .detail-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .detail-table tr:hover {
            background-color: #ddd;
        }
    </style>
</head>

<body>
    <?php include('../navbar.php'); ?>
    <div class="detail-container">
    <h2>Detail Laporan Pelanggaran Mahasiswa</h2>

    <p><a href="mahasiswa_dashboard.php?page=pelanggaran" class="btn-back">Kembali ke Daftar Laporan</a></p>

    <table class="detail-table">
        <tr>
            <th>Nama Dosen Pelapor</th>
            <td><?= htmlspecialchars($laporan_detail['nama_dosen']); ?></td>
        </tr>
        <tr>
            <th>Nama Mahasiswa</th>
            <td><?= htmlspecialchars($laporan_detail['nama_mahasiswa']); ?></td>
        </tr>
        <tr>
            <th>Program Studi - Kelas</th>
            <td><?= htmlspecialchars($laporan_detail['prodi']) . '-' . htmlspecialchars($laporan_detail['kelas']); ?></td>
        </tr>
        <tr>
            <th>Tanggal Laporan</th>
            <td><?= htmlspecialchars($laporan_detail['tanggal_laporan']->format('Y-m-d')); ?></td>
        </tr>
        <tr>
            <th>Foto Pelanggaran</th>
            <td>
                <?php if (!empty($laporan_detail['foto_pelanggaran'])): ?>
                    <img src="<?= htmlspecialchars($laporan_detail['foto_pelanggaran']); ?>" alt="Foto Pelanggaran" style="max-width:200px;">
                <?php else: ?>
                    Tidak Ada Foto
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th>Deskripsi Pelanggaran</th>
            <td><?= htmlspecialchars($laporan_detail['deskripsi_pelanggaran']); ?></td>
        </tr>
        <tr>
            <th>Tingkat Sanksi</th>
            <td><?= htmlspecialchars($laporan_detail['tingkat_sanksi']); ?></td>
        </tr>
        <tr>
            <th>Deskripsi Sanksi</th>
            <td><?= htmlspecialchars($laporan_detail['deskripsi_sanksi']); ?></td>
        </tr>
        <tr>
            <th>File Sanksi</th>
            <td>
                <?php if (!empty($laporan_detail['file_sanksi'])): ?>
                    <a href="<?= htmlspecialchars($laporan_detail['file_sanksi']); ?>" download>Unduh File Sanksi</a>
                <?php else: ?>
                    Belum Upload File Sanksi
                <?php endif; ?>
            </td>
        </tr>
    </table>
</div>

</body>

</html>
