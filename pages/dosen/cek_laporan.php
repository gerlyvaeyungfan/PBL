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

if (isset($_SESSION['dosen_id'])) {
$dosen_id = intval($_SESSION['dosen_id']);
}

$query_laporan = "EXEC sp_get_verifikasi_pelanggaran_mahasiswa @dpa_id = ?;";
$params_laporan = [$dosen_id];
$stmt_laporan = sqlsrv_prepare($conn, $query_laporan, $params_laporan);

if ($stmt_laporan === false) {
    die(print_r(sqlsrv_errors(), true)); // Tampilkan error jika terjadi kesalahan
}

// Eksekusi query laporan
$pelanggaran_list = [];

if (sqlsrv_execute($stmt_laporan)) {
    while ($row = sqlsrv_fetch_array($stmt_laporan, SQLSRV_FETCH_ASSOC)) {
        // Pastikan hanya data dengan dpa_id yang sama dengan dosen_id yang ditampilkan
        if ($row['dpa_id'] == $dosen_id) {
            $pelanggaran_list[] = [
                'id_laporan' => $row['id_laporan'],
                'tanggal_laporan' => $row['tanggal_laporan'],
                'nama_dosen' => $row['nama_dosen'],
                'nama_mahasiswa' => $row['nama_mahasiswa'],
                'prodi' => $row['prodi'],
                'kelas' => $row['kelas'],
                'deskripsi_pelanggaran' => $row['deskripsi_pelanggaran'],
                'tingkat_sanksi' => $row['tingkat_sanksi'],
                'deskripsi_sanksi' => $row['deskripsi_sanksi'],
                'status_verifikasi' => $row['status_verifikasi'],
                'tgl_verifikasi' => $row['tgl_verifikasi'],
                'dpa_id' => $row['dpa_id'],
            ];
        }
    }
} else {
    die("Error executing query.");
}

// Proses verifikasi jika ada parameter di URL
if (isset($_GET['verifikasi']) && isset($_GET['id_laporan'])) {
    $laporan_id = intval($_GET['id_laporan']);
    $status_verifikasi = intval($_GET['verifikasi']);

    if ($laporan_id > 0) {
        // Update query sesuai status
        if ($status_verifikasi === 1) {
            $sql_update = "
                UPDATE laporan 
                SET status_verifikasi = ?, 
                    tgl_verifikasi = GETDATE()
                WHERE id = ? 
                  AND dpa_id = ?;
            ";
        } else {
            $sql_update = "
                UPDATE laporan 
                SET status_verifikasi = ?, 
                    tgl_verifikasi = NULL
                WHERE id = ? 
                  AND dpa_id = ?;
            ";
        }

        $params_update = [$status_verifikasi, $laporan_id, $dosen_id];

        // Jalankan update
        $stmt_update = sqlsrv_query($conn, $sql_update, $params_update);
        if ($stmt_update === false) {
            die(print_r(sqlsrv_errors(), true)); 
        } else {
            // Setelah verifikasi, arahkan kembali ke halaman cek_laporan
            header('Location: dosen_dashboard.php?page=cek_laporan');  // Arahkan tanpa parameter id_laporan dan status_verifikasi
            ob_end_clean();
        }
    } else {
        echo "<p>ID laporan atau status tidak valid.</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Pelanggaran Mahasiswa</title>
    <link rel="stylesheet" href="../../view/style/Dosencss.css">
    <style>
        .button {
            display: inline-block;
            padding: 5px 13px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .button-green {
            background-color: green;
        }

        .button-green:hover {
            background-color: darkgreen;
        }

        .button-red {
            background-color: red;
        }

        .button-red:hover {
            background-color: darkred;
        }
        th, td {
            padding: 5px;
            font-size: 14px;
        }

        table {
            width: 100%;
            margin-bottom: 20px;
        }

        th {
            background-color: #004080;
            color: white;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .btn-blue {
            background-color: lightblue;
            color: black;
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            text-decoration: none;
            font-size: 12px;

        }

        .btn-blue:hover {
            background-color: #003060;
            color: white;
        }
    </style>
</head>

<body>
    <?php include('../navbar.php'); ?>
    <?php include('sidebar_dosen.php'); ?>

    <div style="background-color: #ffffff; padding: 20px; border-radius: 8px;">
        <?php if (!empty($pelanggaran_list)): ?>
            <h2>Verifikasi Pelanggaran Mahasiswa</h2>
            <table border="1" cellpadding="5" cellspacing="0" style="width: 100%;">
                <thead>
                    <tr style="background-color: #004080; color: white;">
                        <th>No</th>
                        <th>Tanggal Laporan</th>
                        <th>Nama Mahasiswa</th>
                        <th>Kelas</th>
                        <th>Deskripsi Pelanggaran</th>
                        <th>Tanggal Verifikasi</th>
                        <th>Status</th>
                        <th>Verifikasi Pelanggaran</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($pelanggaran_list as $row): ?>
                        <tr>
                            <td style="text-align: center;"><?= $no++; ?></td>
                            <td style="text-align: center;"><?= htmlspecialchars($row['tanggal_laporan']->format('Y-m-d')); ?></td>
                            <td><?= htmlspecialchars($row['nama_mahasiswa']); ?></td>
                            <td style="text-align: center;"><?= htmlspecialchars($row['prodi']) . '-' . htmlspecialchars($row['kelas']); ?></td>
                            <td><?= htmlspecialchars($row['deskripsi_pelanggaran']); ?></td>
                            <td style="text-align: center;"><?= htmlspecialchars($row['tgl_verifikasi'] ? $row['tgl_verifikasi']->format('Y-m-d') : '-'); ?></td>
                            <td><?= $row['status_verifikasi'] ? 'Terverifikasi' : 'Belum Diverifikasi'; ?></td>
                            <td style="justify-content: center; align-items: center; gap: 10px;  text-align: center;">
                                <a href="dosen_dashboard.php?page=cek_laporan&verifikasi=1&id_laporan=<?= $row['id_laporan']; ?>" class="button button-green">✓</a>
                                <a href="dosen_dashboard.php?page=cek_laporan&verifikasi=0&id_laporan=<?= $row['id_laporan']; ?>" class="button button-red">✘</a>
                            </td>
                            <td style="text-align: center;">
                                <a href="dosen_dashboard.php?page=detail_pelanggaran&id_laporan=<?= $row['id_laporan']; ?>" class="btn-blue">Lihat</a>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <h2>Tidak ada data pelanggaran mahasiswa.</h2>
        <?php endif; ?>
    </div>
</body>

</html>