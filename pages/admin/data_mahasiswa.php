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
    echo '<h2 style="margin: 0;">Daftar Data Mahasiswa</h2>';

    // Tombol Tambah Mahasiswa
    echo '<a href="admin_dashboard.php?page=tambah_mahasiswa" style="text-decoration: none; background-color: #004080; color: white; padding: 10px 20px; border-radius: 5px; font-weight: bold;">Tambah Mahasiswa</a>';
    echo '</div>';
    echo '<p>Menampilkan seluruh data Mahasiswa</p>';
    echo '<table border="1" cellpadding="10" cellspacing="0">';
    echo '<tr>
            <th>No.</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Jenis Kelamin</th>
            <th>Kelas</th>
            <th>DPA</th>
        </tr>';

    $no = 1; // Inisialisasi nomor urut
    foreach ($mahasiswa as $data_mhs) {
        echo '<tr>';
        echo '<td>' . $no . '</td>'; // Menampilkan nomor urut
        echo '<td>' . htmlspecialchars($data_mhs['nama']) . '</td>';
        echo '<td>' . htmlspecialchars($data_mhs['nim']) . '</td>';
        echo '<td>' . htmlspecialchars($data_mhs['jk']) . '</td>';
        echo '<td>' . htmlspecialchars($data_mhs['prodi'] . '-' . $data_mhs['kelas']) . '</td>';
        echo '<td>' . htmlspecialchars($data_mhs['Nama DPA']) . '</td>';
        echo '</tr>';
        $no++; // Increment nomor urut
    }

    echo '</table>';
?>
</div>
