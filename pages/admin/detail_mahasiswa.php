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

if (isset($_GET['page']) && $_GET['page'] === 'detail_mahasiswa' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mengambil data detail mahasiswa berdasarkan ID
    $query = "
        SELECT 
            m.nama AS nama_mahasiswa,
            m.nim,
            m.jk,
            m.ttl,
            m.alamat,
            m.email,
            m.prodi,
            m.kelas,
            m.foto_mahasiswa,
            d.nama AS nama_dpa
        FROM mahasiswa m
        LEFT JOIN dosen d ON m.dpa_id = d.id
        WHERE m.id = ?";
    $params = array($id);
    $stmt = sqlsrv_query($conn, $query, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $data_mhs = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

    if ($data_mhs) {
        // Tampilkan data detail mahasiswa
        echo '<div class="detail-mahasiswa">';
        echo '<h2>Detail Mahasiswa</h2>';
        if (!empty($data_mhs['foto_mahasiswa'])) {
            echo '<p><img src="' . htmlspecialchars($data_mhs['foto_mahasiswa']) . '" alt="Foto Mahasiswa" class="foto-mahasiswa"></p>';
        } else {
            echo '<p>Foto tidak tersedia</p>';
        }
        echo '<div class="biodata">';
        echo '<div><strong>Nama</strong></div><div>: ' . htmlspecialchars($data_mhs['nama_mahasiswa']) . '</div>';
        echo '<div><strong>NIM</strong></div><div>: ' . htmlspecialchars($data_mhs['nim']) . '</div>';
        echo '<div><strong>Jenis Kelamin</strong></div><div>: ' . htmlspecialchars($data_mhs['jk']) . '</div>';
        echo '<div><strong>Tempat Tanggal Lahir</strong></div><div>: ' . htmlspecialchars($data_mhs['ttl']) . '</div>';
        echo '<div><strong>Alamat</strong></div><div>: ' . htmlspecialchars($data_mhs['alamat']) . '</div>';
        echo '<div><strong>Email</strong></div><div>: ' . htmlspecialchars($data_mhs['email']) . '</div>';
        echo '<div><strong>Prodi</strong></div><div>: ' . htmlspecialchars($data_mhs['prodi']) . '</div>';
        echo '<div><strong>Kelas</strong></div><div>: ' . htmlspecialchars($data_mhs['kelas']) . '</div>';
        echo '<div><strong>Nama DPA</strong></div><div>: ' . htmlspecialchars($data_mhs['nama_dpa']) . '</div>';
        echo '</div>';
        echo '</div>';
    } else {
        echo '<p>Data mahasiswa tidak ditemukan.</p>';
    }
}
?>

<head>
    <meta charset="UTF-8">
    <title>Detail Mahasiswa</title>
    <style>
        /* Styling untuk kontainer detail mahasiswa */
        .detail-mahasiswa {
            background-color: #ffffff;
            padding: 20px;
            padding-bottom: 30px;
            margin: 0;
            border-radius: 8px;
            width: 100%;
            box-sizing: border-box;
        }

        /* Styling untuk judul */
        .detail-mahasiswa h2 {
            text-align: left;
            color: #004080;
            margin-top: 5px;
            font-size: 22px;
        }

        /* Styling untuk gambar foto mahasiswa */
        .foto-mahasiswa {
            width: 100px;
            border-radius: 5px;
        }

        /* Styling untuk kontainer biodata */
        .biodata {
            display: grid;
            grid-template-columns: 180px 1fr;
            gap: 10px;
            font-size: 16px;
            font-weight: bold;
        }

        /* Styling untuk elemen paragraf */
        .biodata div {
            margin-bottom: 2px;
        }

        /* Styling untuk label strong */
        .biodata strong {
            color:rgb(16, 16, 16);
            text-align: right;
            font-weight: bold;
        }
    </style>
</head>
