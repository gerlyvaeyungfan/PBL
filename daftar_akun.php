<?php
// Cek apakah pengguna sudah login dan memiliki role 'admin'
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php'); // Arahkan ke halaman login jika bukan admin
    exit;
}

// Menambahkan fitur logout
if (isset($_GET['logout'])) {
    session_destroy();  // Hapus sesi
    header('Location: login.php'); // Arahkan ke halaman login setelah logout
    exit;
}

include('controller/lib/Connection.php');

// Penggunaan
$connection = new Connection();
$conn = $connection->connect();

// Tangani pencarian username
$search = isset($_GET['search']) ? $_GET['search'] : '';

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

// Jika ada permintaan penghapusan akun
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Query untuk menghapus akun berdasarkan id
    $delete_sql = "DELETE FROM akun WHERE id = ?";
    $delete_stmt = sqlsrv_query($conn, $delete_sql, array($delete_id));

    if ($delete_stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        echo "<script>alert('Akun berhasil dihapus!'); window.location.href = 'daftar_akun.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .table-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
            max-height: 500px;
            overflow-y: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #cce7ff;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #004080;
            color: #ffffff;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        a {
            color: #004080;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            color: #003366;
        }
        .delete-btn, .edit-btn {
            color: white;
            border: none;
            padding: 5px 8px;
            cursor: pointer;
            border-radius: 4px;
        }
        .delete-btn {
            background-color: #ff4d4d;
        }
        .edit-btn {
            background-color: #ffd700;
        }
        .edit-btn:hover {
            background-color: #ffcc00;
        }
        th:last-child, td:last-child {
            width: 150px;
            text-align: center;
        }
        th:nth-child(4), td:nth-child(4) {
            width: 120px;
        }
        .tambah-akun {
            background-color: green; 
            color: white; 
            padding: 10px 15px; 
            text-decoration: none; 
            border-radius: 5px; 
            font-weight: bold;
        }
        .tambah-akun:hover {
            color: white;
        }
        .addAkun {
            display: flex;
            justify-content: space-between; /* Pencarian di kiri, tambah akun di kanan */
            align-items: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="table-container">
    <!-- Tombol Tambah Akun -->
    <div class="addAkun" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <!-- Form pencarian di kiri -->
        <form action="daftar_akun.php" method="GET" style="display: flex; align-items: center;">
            <input type="text" name="search" placeholder="Cari username..." value="<?php echo htmlspecialchars($search); ?>" style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            <button type="submit" style="background-color: #004080; color: white; padding: 8px 15px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; margin-left: 10px;">Cari</button>
        </form>

        <!-- Tombol Tambah Akun di kanan -->
        <a href="register.php" class="tambah-akun">Tambah Akun</a>
    </div>
    
    <?php if ($search): ?>
        <h2 style="color: rgba(0, 0, 0, 0.6);">Hasil Pencarian untuk: <?php echo htmlspecialchars($search); ?></h2>

    <?php endif; ?>

    <!-- Tampilkan Daftar Akun berdasarkan pencarian -->
    <?php if ($stmt_admin && sqlsrv_has_rows($stmt_admin)): ?>
        <h1>Daftar Akun Admin</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>ID Dosen</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = sqlsrv_fetch_array($stmt_admin, SQLSRV_FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['role']; ?></td>
                    <td><?php echo $row['dosen_id']; ?></td>
                    <td>
                        <a href="edit_akun.php?id=<?php echo $row['id']; ?>" class="edit-btn">Edit</a> | 
                        <a href="?delete_id=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini?');">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <?php if ($stmt_dosen && sqlsrv_has_rows($stmt_dosen)): ?>
        <h1>Daftar Akun Dosen</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>ID Dosen</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = sqlsrv_fetch_array($stmt_dosen, SQLSRV_FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['role']; ?></td>
                    <td><?php echo $row['dosen_id']; ?></td>
                    <td>
                        <a href="edit_akun.php?id=<?php echo $row['id']; ?>" class="edit-btn">Edit</a> | 
                        <a href="?delete_id=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini?');">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <?php if ($stmt_mahasiswa && sqlsrv_has_rows($stmt_mahasiswa)): ?>
        <h1>Daftar Akun Mahasiswa</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>ID Mahasiswa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = sqlsrv_fetch_array($stmt_mahasiswa, SQLSRV_FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['role']; ?></td>
                    <td><?php echo $row['mahasiswa_id']; ?></td>
                    <td>
                        <a href="edit_akun.php?id=<?php echo $row['id']; ?>" class="edit-btn">Edit</a> | 
                        <a href="?delete_id=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini?');">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

</body>
</html>
