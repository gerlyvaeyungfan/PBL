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
<div style="
    background-color:
    #ffffff;
    padding: 
    20px; 
    padding-bottom: 30px; 
    margin: 0; 
    border-radius: 8px; 
    width: calc(100% - 0px); 
    height: 100%;
    box-sizing:
    border-box;">
<style>
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
</style>
<?php 

    // Membungkus judul dan tombol dalam satu div
    echo '<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; margin-top: 0px;">';

    // Judul Daftar Data Mahasiswa
    echo '<h2 style="margin: 0px;">Daftar Data Dosen</h2>';

    // Tombol Tambah Mahasiswa
    echo '<a href="admin_dashboard.php?page=tambah_mahasiswa" style="text-decoration: none; background-color: #004080; color: white; padding: 10px 20px; border-radius: 5px; font-weight: bold;">Tambah Mahasiswa</a>';
    echo '</div>';
    echo '<p>Menampilkan seluruh data Mahasiswa</p>';
    echo '<table border="1" cellpadding="10" cellspacing="0">';
    echo '<tr>
    <th style="text-align: center;">No.</th>
    <th>Nama Lengkap</th>
    <th>NIDN</th>
    <th>Jenis Kelamin</th>
    <th>Alamat</th>
    <th>Alamat Email</th>
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
        echo '<td style="text-align: center;">Lihat</td>';
        echo '</tr>';
        $no++; // Increment nomor urut
    }
    echo '</table>';
    echo '<br>';
?>               