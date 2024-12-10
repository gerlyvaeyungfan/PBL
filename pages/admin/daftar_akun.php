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

// daftar_akun.php
if (isset($_GET['search'])) {
    $search = $_GET['search'];
} else {
    $search = '';
}


// Query SQL untuk akun admin, dosen, dan mahasiswa dengan filter pencarian
$sql_admin = "SELECT id, username, role, dosen_id FROM akun WHERE role = 'admin' AND username LIKE ?";
$stmt_admin = sqlsrv_query($conn, $sql_admin, array("%$search%"));

$sql_dosen = "SELECT id, username, role, dosen_id FROM akun WHERE role = 'dosen' AND username LIKE ?";
$stmt_dosen = sqlsrv_query($conn, $sql_dosen, array("%$search%"));

$sql_mahasiswa = "SELECT id, username, role, mahasiswa_id FROM akun WHERE role = 'mahasiswa' AND username LIKE ?";
$stmt_mahasiswa = sqlsrv_query($conn, $sql_mahasiswa, array("%$search%"));

if ($stmt_admin === false || $stmt_dosen === false || $stmt_mahasiswa === false) {
    die(print_r(sqlsrv_errors(), true));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun</title>
    <style>
        .content {
        position: relative;
        padding: 0px 0px;
        width: 100%; /* Menggunakan lebar penuh */
        height: auto; /* Menyesuaikan tinggi konten */
        max-width: none; /* Menghilangkan batasan lebar */
        margin: 0; /* Menghilangkan margin kiri dan kanan */
        background-color: white;
        overflow-y: auto; /* Memastikan konten yang banyak bisa di-scroll */
        box-sizing: border-box; /* Menjaga margin dan padding dalam lebar elemen */
        }
        table th{
            border: 1px solid #cce7ff;
            padding: 10px;
            text-align: left;
            font-size: 14px;
        }
        table td {
            font-size: 14px;
        }
        h1 {
            font-size: 22px;
        }

    </style>
</head>
<body>
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
<!-- Tombol Tambah Akun -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <!-- Form pencarian di kiri -->
        <form method="GET" action="admin_dashboard.php" style="display: flex; align-items: center; margin-bottom: 10px; margin-top: 10px;">
            <input type="hidden" name="page" value="daftar_akun">
            <input 
                type="text" 
                name="search" 
                placeholder="Cari Username" 
                value="<?= htmlspecialchars($search) ?>" 
                style="padding: 10px; font-size: 14px; width: 250px; border: 1px solid #ccc; border-radius: 5px; margin-right: 10px; margin-bottom: 10px;"
            >
            <button 
                type="submit" 
                style="margin-bottom: 10px; padding: 10px; font-size: 14px; background-color: #007BFF; color: white; border: none; border-radius: 5px; cursor: pointer; width: 75px; text-align: center;">
                Cari
            </button>
        </form>

        <!-- Tombol Tambah Akun di kanan -->
        <a href="admin_dashboard.php?page=tambah_akun" style="background-color: green; color: white; padding: 10px; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 14px; text-align: center; width: 150px;">Tambah Akun</a>
    </div>
    
    <?php if ($search): ?>
        <h2 style="color: rgba(0, 0, 0, 0.6);">Hasil Pencarian untuk: <?php echo htmlspecialchars($search); ?></h2>
    <?php endif; ?>

    <!-- Tampilkan Daftar Akun Admin -->
    <?php if ($stmt_admin && sqlsrv_has_rows($stmt_admin)): ?>
        <h1>Daftar Akun Admin</h1>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="border: 1px solid #cce7ff; padding: 10px; text-align: left; background-color: #004080; color: #ffffff;">ID</th>
                    <th style="border: 1px solid #cce7ff; padding: 10px; text-align: left; background-color: #004080; color: #ffffff;">Username</th>
                    <th style="border: 1px solid #cce7ff; padding: 10px; text-align: left; background-color: #004080; color: #ffffff;">Role</th>
                    <th style="border: 1px solid #cce7ff; padding: 10px; text-align: left; background-color: #004080; color: #ffffff;">ID Dosen</th>
                    <th style="border: 1px solid #cce7ff; padding: 10px; text-align: center; background-color: #004080; color: #ffffff; width: 130px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = sqlsrv_fetch_array($stmt_admin, SQLSRV_FETCH_ASSOC)): ?>
                <tr style="background-color: <?php echo $loop_index++ % 2 == 0 ? '#ffffff' : '#f9f9f9'; ?>;">
                    <td style="border: 1px solid #cce7ff; padding: 10px;"><?php echo $row['id']; ?></td>
                    <td style="border: 1px solid #cce7ff; padding: 10px;"><?php echo $row['username']; ?></td>
                    <td style="border: 1px solid #cce7ff; padding: 10px;"><?php echo $row['role']; ?></td>
                    <td style="border: 1px solid #cce7ff; padding: 10px;"><?php echo $row['dosen_id']; ?></td>
                    <td style="border: 1px solid #cce7ff; padding: 10px; text-align: center;">
                        <a href="admin_dashboard.php?page=edit_akun&id=<?php echo $row['id']; ?>" style="background-color: #ffd700; color: white; padding: 5px 8px; border-radius: 4px; text-decoration: none;">Edit</a> | 
                        <a href="admin_dashboard.php?page=hapus_akun&id=<?php echo $row['id']; ?>" style="background-color: #ff4d4d; color: white; padding: 5px 8px; border-radius: 4px; text-decoration: none;">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <br>
    <?php endif; ?>

    <!-- Tampilkan Daftar Akun Dosen -->
    <?php if ($stmt_dosen && sqlsrv_has_rows($stmt_dosen)): ?>
    <h1>Daftar Akun Dosen</h1>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="border: 1px solid #cce7ff; padding: 10px; text-align: left; background-color: #004080; color: #ffffff;">ID</th>
                <th style="border: 1px solid #cce7ff; padding: 10px; text-align: left; background-color: #004080; color: #ffffff;">Username</th>
                <th style="border: 1px solid #cce7ff; padding: 10px; text-align: left; background-color: #004080; color: #ffffff;">Role</th>
                <th style="border: 1px solid #cce7ff; padding: 10px; text-align: left; background-color: #004080; color: #ffffff;">ID Dosen</th>
                <th style="border: 1px solid #cce7ff; padding: 10px; text-align: center; background-color: #004080; color: #ffffff; width: 130px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = sqlsrv_fetch_array($stmt_dosen, SQLSRV_FETCH_ASSOC)): ?>
            <tr style="background-color: <?php echo $loop_index++ % 2 == 0 ? '#f9f9f9' : '#ffffff'; ?>;">
                <td style="border: 1px solid #cce7ff; padding: 10px;"><?php echo $row['id']; ?></td>
                <td style="border: 1px solid #cce7ff; padding: 10px;"><?php echo $row['username']; ?></td>
                <td style="border: 1px solid #cce7ff; padding: 10px;"><?php echo $row['role']; ?></td>
                <td style="border: 1px solid #cce7ff; padding: 10px;"><?php echo $row['dosen_id']; ?></td>
                <td style="border: 1px solid #cce7ff; padding: 10px; text-align: center;">
                    <a href="admin_dashboard.php?page=edit_akun&id=<?php echo $row['id']; ?>" style="background-color: #ffd700; color: white; padding: 5px 8px; border-radius: 4px; text-decoration: none;">Edit</a> | 
                    <a href="admin_dashboard.php?page=hapus_akun&id=<?php echo $row['id']; ?>" style="background-color: #ff4d4d; color: white; padding: 5px 8px; border-radius: 4px; text-decoration: none;">Hapus</a>
            </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <br>
    <?php endif; ?>

    <!-- Tampilkan Daftar Akun Mahasiswa -->
    <?php if ($stmt_mahasiswa && sqlsrv_has_rows($stmt_mahasiswa)): ?>
    <h1>Daftar Akun Mahasiswa</h1>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="border: 1px solid #cce7ff; padding: 10px; text-align: left; background-color: #004080; color: #ffffff;">ID</th>
                <th style="border: 1px solid #cce7ff; padding: 10px; text-align: left; background-color: #004080; color: #ffffff;">Username</th>
                <th style="border: 1px solid #cce7ff; padding: 10px; text-align: left; background-color: #004080; color: #ffffff;">Role</th>
                <th style="border: 1px solid #cce7ff; padding: 10px; text-align: left; background-color: #004080; color: #ffffff;">ID Mahasiswa</th>
                <th style="border: 1px solid #cce7ff; padding: 10px; text-align: center; background-color: #004080; color: #ffffff; width: 130px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = sqlsrv_fetch_array($stmt_mahasiswa, SQLSRV_FETCH_ASSOC)): ?>
            <tr style="background-color: <?php echo $loop_index++ % 2 == 0 ? '#f9f9f9' : '#ffffff'; ?>;">
                <td style="border: 1px solid #cce7ff; padding: 10px;"><?php echo $row['id']; ?></td>
                <td style="border: 1px solid #cce7ff; padding: 10px;"><?php echo $row['username']; ?></td>
                <td style="border: 1px solid #cce7ff; padding: 10px;"><?php echo $row['role']; ?></td>
                <td style="border: 1px solid #cce7ff; padding: 10px;"><?php echo $row['mahasiswa_id']; ?></td>
                <td style="border: 1px solid #cce7ff; padding: 10px; text-align: center;">
                    <a href="admin_dashboard.php?page=edit_akun&id=<?php echo $row['id']; ?>" style="background-color: #ffd700; color: white; padding: 5px 8px; border-radius: 4px; text-decoration: none;">Edit</a> | 
                    <a href="admin_dashboard.php?page=hapus_akun&id=<?php echo $row['id']; ?>" style="background-color: #ff4d4d; color: white; padding: 5px 8px; border-radius: 4px; text-decoration: none;">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <br>
    <?php endif; ?>
</div>

</body>
</html>
