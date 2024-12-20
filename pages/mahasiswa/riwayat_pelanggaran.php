<?php

ob_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'mahasiswa') {
    header('Location: mahasiswa_dashboard.php');
    exit;
}

if (isset($_SESSION['mahasiswa_id'])) {
    $mahasiswa_id = intval($_SESSION['mahasiswa_id']);
}

if (!isset($_SESSION['mahasiswa_id']) || empty($_SESSION['mahasiswa_id'])) {
    header('Location: mahasiswa_dashboard.php');
    ob_end_clean();
}

require_once('../../controller/lib/Connection.php'); // Pastikan koneksi database tersedia

$query_laporan = "EXEC sp_get_detail_pelanggaran_mahasiswa @mhs_id = ?, @status_verifikasi = 1;";
$params_laporan = [$mahasiswa_id];
$stmt_laporan = sqlsrv_prepare($conn, $query_laporan, $params_laporan);

if ($stmt_laporan === false) {
    die(print_r(sqlsrv_errors(), true)); // Tampilkan error jika terjadi kesalahan
}

// Eksekusi query laporan
$pelanggaran_list = [];

if (sqlsrv_execute($stmt_laporan)) {
    while ($row = sqlsrv_fetch_array($stmt_laporan, SQLSRV_FETCH_ASSOC)) {
        // Pastikan hanya data dengan dpa_id yang sama dengan dosen_id yang ditampilkan
        if ($row['mhs_id'] == $mahasiswa_id) {
            $pelanggaran_list[] = [
                'id_laporan' => $row['id_laporan'],
                'tanggal_laporan' => $row['tanggal_laporan'],
                'nama_dosen' => $row['nama_dosen'],
                'nama_mahasiswa' => $row['nama_mahasiswa'],
                'prodi' => $row['prodi'],
                'kelas' => $row['kelas'],
                'deskripsi_pelanggaran' => $row['deskripsi_pelanggaran'],
                'tingkat_sanksi' => $row['tingkat_sanksi'],
                'file_sanksi' => $row['file_sanksi'],
                'surat_sanksi' => $row['surat_sanksi'],
                'deskripsi_sanksi' => $row['deskripsi_sanksi'],
                'status_verifikasi' => $row['status_verifikasi'],
                'tgl_verifikasi' => $row['tgl_verifikasi'],
                'dpa_id' => $row['dpa_id'],
                'mhs_id' => $row['mhs_id'],
            ];
        }
    }
} else {
    die("Error executing query.");
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        th,
        td {
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
    <?php include('sidebar_mahasiswa.php'); ?>

    <div style="background-color: #ffffff; padding: 20px; padding-bottom: 30px; margin: 0; border-radius: 8px; width: calc(100% - 0px); height: 100%; max-height: 460px; overflow-y: auto; box-sizing: border-box;">

        <?php if (!empty($pelanggaran_list)): ?>
            <h2>Data Pelanggaran Anda</h2>
            <table border="1" cellpadding="5" cellspacing="0" style="width: 100%;">
                <thead>
                    <tr style="background-color: #004080; color: white;">
                        <th>No</th>
                        <th>Tanggal Laporan</th>
                        <th>Deskripsi Pelanggaran</th>
                        <th>Tingkat</th>
                        <th>Sanksi</th>
                        <th>Unduh File Sanksi</th>
                        <th>Upload Bukti Sanksi</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($pelanggaran_list as $row): ?>
                        <tr>
                            <td style="text-align: center;"><?= $no++; ?></td>
                            <td style="text-align: center;"><?= htmlspecialchars($row['tanggal_laporan']->format('Y-m-d')); ?></td>
                            <td><?= htmlspecialchars($row['deskripsi_pelanggaran']); ?></td>
                            <td><?= htmlspecialchars($row['tingkat_sanksi']); ?></td>
                            <td><?= htmlspecialchars($row['deskripsi_sanksi']); ?></td>
                            <td style="text-align: center; vertical-align: middle;">
                                <?php if (!empty($row['surat_sanksi'])): ?>
                                    <a href="<?= htmlspecialchars($row['surat_sanksi']); ?>" download class="btn-blue">Unduh</a>
                                <?php else: ?>
                                    Tidak ada file
                                <?php endif; ?>
                            </td>
                            <td style="text-align: center;">
                                <a href="mahasiswa_dashboard.php?page=sanksi&id_laporan=<?= $row['id_laporan']; ?>" class="btn-blue">Upload</a>
                            </td>
                            <td style="text-align: center;">
                                <a href="mahasiswa_dashboard.php?page=detail_laporan&id_laporan=<?= $row['id_laporan']; ?>" class="btn-blue">Lihat</a>
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
