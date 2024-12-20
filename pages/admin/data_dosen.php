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
    <style>
        
        td {
            padding: 5px;
            font-size: 12px;
        }

        table {
            width: 100%;
            margin-bottom: 20px;
        }

        th {
            background-color: #004080;
            color: white;
            text-align: left;
            font-size: 14px;
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
            padding: 3px 10px;
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
    <?php

    echo '<div style="
    background-color: #ffffff;
    padding: 20px; 
    padding-bottom: 30px; 
    margin: 0; 
    border-radius: 8px; 
    width: calc(100% - 0px); 
    height: 100%;
    box-sizing:
    border-box;">';
    // Judul Daftar Data Mahasiswa
    echo '<h2 style="margin: 0px;">Daftar Data Dosen</h2>';

    echo '<p>Menampilkan seluruh data Dosen</p>';
    echo '<table border="1" cellpadding="10" cellspacing="0">';
    echo '<tr>
    <th style="text-align: center;">No.</th>
    <th>Nama Lengkap</th>
    <th>NIDN</th>
    <th>Jenis Kelamin</th>
    <th>Alamat</th>
    <th>Email</th>
    <th style="text-align: center;">Detail</th>
    </tr>';

    $no = 1;
    foreach ($dosen as $data) {
        echo '<tr>';
        echo '<td style="text-align: center;">' . $no . '</td>'; // Menampilkan nomor urut
        echo '<td>' . htmlspecialchars($data['nama']) . '</td>';
        echo '<td>' . htmlspecialchars($data['nidn']) . '</td>';
        echo '<td>' . htmlspecialchars($data['jk']) . '</td>';
        echo '<td>' . htmlspecialchars($data['alamat']) . '</td>';
        echo '<td>' . htmlspecialchars($data['email']) . '</td>';
        echo '<td style="text-align: center;">
        <a href="admin_dashboard.php?page=detail_dosen&id=' . urlencode($data['id']) . '" class="btn-blue">Lihat</a>
        </td>';
        echo '</tr>';
        $no++; // Increment nomor urut
    }
    echo '</table>';
    echo '<br>';
    ?>