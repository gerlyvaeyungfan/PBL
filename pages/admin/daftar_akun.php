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

if (isset($_GET['page']) && $_GET['page'] === 'daftar_akun' && isset($_GET['id'])) {
    $id = $_GET['id'];
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
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id']) && $_GET['delete_id'] == $id) {
    // Query untuk menghapus data mahasiswa berdasarkan ID
    $delete_query = "DELETE FROM akun WHERE id = ?";
    $delete_params = array($id);
    $delete_stmt = sqlsrv_query($conn, $delete_query, $delete_params);

    if ($delete_stmt) {
        // Redirect ke halaman data mahasiswa setelah berhasil menghapus
        header('Location: admin_dashboard.php?page=daftar_akun');
        exit; // Menghentikan eksekusi lebih lanjut
    } else {
        echo '<p>Terjadi kesalahan saat menghapus data.</p>';
    }
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
            padding: 0;
            width: 100%;
            height: auto;
            max-width: none;
            margin: 0;
            background-color: white;
            overflow-y: auto;
            box-sizing: border-box;
        }

        table th {
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

        /* Styling for search bar and button */
        .search-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .search-form {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            margin-top: 10px;
            flex-grow: 1;
        }

        .search-input {
            padding: 10px;
            font-size: 14px;
            width: 100%;
            max-width: 250px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
        }

        .search-button {
            padding: 10px;
            font-size: 14px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 75px;
            text-align: center;
        }

        .add-account-button {
            background-color: green;
            color: white;
            padding: 10px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            font-size: 14px;
            text-align: center;
            margin-left: 10px;
            width: 120px;
            display: inline-block;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }


        .table-header {
            background-color: #004080;
            color: #ffffff;
        }

        .table-cell {
            border: 1px solid #cce7ff;
            padding: 5px;
        }

        .action-buttons {
            border: 1px solid #cce7ff;
            text-align: center;
            width: 150px;
        }

        .edit-button {
            background-color: #ffd700;
            color: white;
            padding: 3px 8px;
            border-radius: 4px;
            text-decoration: none;
        }

        .delete-button {
            border: 0px;
            background-color: #ff4d4d;
            color: white;
            padding: 3px 8px;
            border-radius: 4px;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div style="
    background-color: #ffffff;
    padding: 20px; 
    padding-bottom: 30px; 
    margin: 0; 
    border-radius: 8px; 
    width: calc(100% - 0px); 
    height: 100%;
    box-sizing:
    border-box;">
        <div class="content">
            <!-- Tombol Tambah Akun -->
            <div class="search-container">
                <!-- Form pencarian di kiri -->
                <form method="GET" action="admin_dashboard.php" class="search-form">
                    <input type="hidden" name="page" value="daftar_akun">
                    <input
                        type="text"
                        name="search"
                        placeholder="Cari Username"
                        value="<?= htmlspecialchars($search) ?>"
                        class="search-input">
                    <button
                        type="submit"
                        class="search-button">
                        Cari
                    </button>
                </form>

                <!-- Tombol Tambah Akun di kanan -->
                <a href="admin_dashboard.php?page=tambah_akun" class="add-account-button">
                    Tambah Akun
                </a>
            </div>

            <?php if ($search): ?>
                <h2 style="color: rgba(0, 0, 0, 0.6);">Hasil Pencarian untuk: <?php echo htmlspecialchars($search); ?></h2>
            <?php endif; ?>

            <!-- Tampilkan Daftar Akun Admin -->
            <?php if ($stmt_admin && sqlsrv_has_rows($stmt_admin)): ?>
                <h1>Daftar Akun Admin</h1>
                <table>
                    <thead>
                        <tr class="table-header">
                            <th class="table-cell" style="text-align: center;">No</th>
                            <th class="table-cell">Username</th>
                            <th class="table-cell">Role</th>
                            <th class="table-cell">ID Dosen</th>
                            <th class="table-cell" style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $loop_admin = 0; // Pastikan $loop_index diinisialisasi sebelum digunakan
                        while ($row = sqlsrv_fetch_array($stmt_admin, SQLSRV_FETCH_ASSOC)): ?>
                            <tr style="background-color: <?php echo $loop_admin++ % 2 == 0 ? '#ffffff' : '#f9f9f9'; ?>;">
                                <td class="table-cell" style="text-align: center;"><?php echo $loop_admin; ?></td>
                                <td class="table-cell"><?php echo htmlspecialchars($row['username']); ?></td>
                                <td class="table-cell"><?php echo htmlspecialchars($row['role']); ?></td>
                                <td class="table-cell"><?php echo htmlspecialchars($row['dosen_id']); ?></td>
                                <td class="action-buttons">
                                    <a href="admin_dashboard.php?page=edit_akun&id=<?php echo $row['id']; ?>" class="edit-button">Edit</a> |
                                    <a href="admin_dashboard.php?page=daftar_akun&id=<?php echo urlencode($row['id']); ?>&delete_id=<?php echo urlencode($row['id']); ?>"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini?')">
                                        <button type="button" class="delete-button">
                                            Hapus
                                        </button>
                                    </a>
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
                <table>
                    <thead>
                        <tr class="table-header">
                            <th class="table-cell" style="text-align: center;">No</th>
                            <th class="table-cell">Username</th>
                            <th class="table-cell">Role</th>
                            <th class="table-cell">ID Dosen</th>
                            <th class="table-cell" style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $loop_dosen = 0;
                        while ($row = sqlsrv_fetch_array($stmt_dosen, SQLSRV_FETCH_ASSOC)): ?>
                            <tr style="background-color: <?php echo $loop_dosen++ % 2 == 0 ? '#f9f9f9' : '#ffffff'; ?>;">
                                <td class="table-cell" style="text-align: center;"><?php echo $loop_dosen; ?></td>
                                <td class="table-cell"><?php echo $row['username']; ?></td>
                                <td class="table-cell"><?php echo $row['role']; ?></td>
                                <td class="table-cell"><?php echo $row['dosen_id']; ?></td>
                                <td class="action-buttons">
                                    <a href="admin_dashboard.php?page=edit_akun&id=<?php echo $row['id']; ?>" class="edit-button">Edit</a> |
                                    <a href="admin_dashboard.php?page=daftar_akun&id=<?php echo urlencode($row['id']); ?>&delete_id=<?php echo urlencode($row['id']); ?>"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini?')">
                                        <button type="button" class="delete-button">
                                            Hapus
                                        </button>
                                    </a>
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
                <table>
                    <thead>
                        <tr class="table-header">
                            <th class="table-cell" style="text-align: center;">No</th>
                            <th class="table-cell">Username</th>
                            <th class="table-cell">Role</th>
                            <th class="table-cell">ID Mahasiswa</th>
                            <th class="table-cell" style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $loop_mhs = 0;
                        while ($row = sqlsrv_fetch_array($stmt_mahasiswa, SQLSRV_FETCH_ASSOC)): ?>
                            <tr style="background-color: <?php echo $loop_mhs++ % 2 == 0 ? '#f9f9f9' : '#ffffff'; ?>;">
                                <td class="table-cell" style="text-align: center;"><?php echo $loop_mhs; ?></td>
                                <td class="table-cell"><?php echo $row['username']; ?></td>
                                <td class="table-cell"><?php echo $row['role']; ?></td>
                                <td class="table-cell"><?php echo $row['mahasiswa_id']; ?></td>
                                <td class="action-buttons">
                                    <a href="admin_dashboard.php?page=edit_akun&id=<?php echo $row['id']; ?>" class="edit-button">Edit</a> |
                                    <a href="admin_dashboard.php?page=daftar_akun&id=<?php echo urlencode($row['id']); ?>&delete_id=<?php echo urlencode($row['id']); ?>"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini?')">
                                        <button type="button" class="delete-button">
                                            Hapus
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
        <br><br><br>
</body>

</html>