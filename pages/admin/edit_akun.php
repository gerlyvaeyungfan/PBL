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

$akun = null; // Variabel untuk menyimpan data akun
$error = null;

$connection = new Connection();
$conn = $connection->connect();

if ($conn === false) {
    die("<p class='error'>Koneksi ke database gagal: " . print_r(sqlsrv_errors(), true) . "</p>");
}

// Proses edit akun
if (isset($_POST['edit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role = $_POST['role'];
    $admin_id = null;
    $dosen_id = null;
    $mahasiswa_id = $_POST['mahasiswa_id'] ?? null;

    // Validasi parameter ID
    if (!isset($_POST['id']) || empty($_POST['id'])) {
        die("<p class='error'>Parameter ID tidak ditemukan. Harap pilih akun yang valid.</p>");
    }
    $id = intval($_POST['id']); // Konversi ID ke integer

    // Validasi username dan role
    if (empty($username)) {
        $error['username'] = "Username wajib diisi.";   
    } else {
        // Set dosen_id dan mahasiswa_id berdasarkan role
        if ($role === 'admin' || $role === 'dosen') {
            $mahasiswa_id = null; // Mahasiswa ID diatur null
            $dosen_id = $_POST['dosen_id'] ?? null; // Tetap gunakan input dosen_id jika ada
            if ($dosen_id) {
                $sql = "SELECT id FROM dosen WHERE id = ?";
                $params = array($dosen_id);
                $stmt = sqlsrv_query($conn, $sql, $params);
                if (!$stmt || !sqlsrv_has_rows($stmt)) {
                    $error['dosen_id'] = "Dosen ID tidak ditemukan di tabel dosen.";
                }
            }
        } elseif ($role === 'mahasiswa') {
            $dosen_id = null; // Dosen ID diatur null
            $dosen_id = $_POST['mahasiswa_id'] ?? null; // Tetap gunakan input dosen_id jika ada
            if ($mahasiswa_id) {
                $sql = "SELECT id FROM mahasiswa WHERE id = ?";
                $params = array($dosen_id);
                $stmt = sqlsrv_query($conn, $sql, $params);
                if (!$stmt || !sqlsrv_has_rows($stmt)) {
                    $error['mahasiswa_id'] = "Mahasiswa ID tidak ditemukan di tabel mahasiswa.";
                }
            }
        } else {
            $dosen_id = null;
            $mahasiswa_id = null;
            $admin_id = null;
        }

        // Periksa apakah password diubah
        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $sql = "UPDATE akun SET username = ?, password = ?, role = ?, dosen_id = ?, mahasiswa_id = ? WHERE id = ?";
            $params = array($username, $hashedPassword, $role, $dosen_id, $mahasiswa_id, $id);
        } else {
            $sql = "UPDATE akun SET username = ?, role = ?, dosen_id = ?, mahasiswa_id = ? WHERE id = ?";
            $params = array($username, $role, $dosen_id, $mahasiswa_id, $id);
        }

        // Eksekusi query
        $stmt = sqlsrv_query($conn, $sql, $params);
        if ($stmt) {
            header('Location: admin_dashboard.php?page=daftar_akun');
            exit;
        } else {
            // Menangani error tanpa menampilkan detail SQL Server
            $errorMsg = sqlsrv_errors();
            if ($errorMsg) {
                $error['sql'] = "Terjadi kesalahan dalam pemrosesan data.";
            }
        }
    }
}

// Ambil data akun berdasarkan ID
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM akun WHERE id = ?";
    $params = array($id);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt && sqlsrv_has_rows($stmt)) {
        $akun = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    } else {
        die("<p class='error'>Data akun dengan ID $id tidak ditemukan.</p>");
    }
}

// Tutup koneksi database
sqlsrv_close($conn);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Akun</title>
    <style>
        .content {
            position: relative;
            padding: 0px 0px;
            width: 100%; /* Menggunakan lebar penuh */
            height: auto; /* Menyesuaikan tinggi konten */
            max-width: none; /* Menghilangkan batasan lebar */
            margin: 0; /* Menghilangkan margin kiri dan kanan */
            background-color: transparent;
            overflow-y: auto; /* Memastikan konten yang banyak bisa di-scroll */
            box-sizing: border-box; /* Menjaga margin dan padding dalam lebar elemen */
        }
        .form-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
        }
        h2 {
            text-align: center;
            color: #004080;
            margin-top: 5px;
        }
        label {
            color: #004080;
            font-weight: bold;
        }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 12px;
            border: 1px solid #cce7ff;
            border-radius: 4px;
            box-sizing: border-box; /* Membuat padding dan border dihitung dalam lebar elemen */
        }
        button {
            background-color: #004080;
            color: #ffffff;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }
        button:hover {
            background-color: #003366;
        }
        .success {
            color: green;
            text-align: center;
            margin-top: 10px;
        }
        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
        .conditional-input {
            display: none;
        }
        form {
            margin: 0; /* Mengatur margin form menjadi 0 */
            width: 100%; /* Pastikan form memanfaatkan seluruh lebar */
            box-sizing: border-box;
        }
    </style>
    <script>
        function toggleRoleInputs() {
            var role = document.getElementById('role').value;
            document.getElementById('dosen_id_input').style.display = (role === 'dosen' || role === 'admin') ? 'block' : 'none';
            document.getElementById('mahasiswa_id_input').style.display = role === 'mahasiswa' ? 'block' : 'none';
        }

        window.onload = function() {
            toggleRoleInputs();
        };
    </script>
</head>
<body>
<div style="background-color: #ffffff; padding: 20px; padding-bottom: 20px; margin: 0; border-radius: 8px; width: calc(100% - 0px); height: 100%; max-height: 460px; overflow-y: auto; box-sizing: border-box;">

        <h2>Edit Akun</h2>
        <form method="POST">
            <?php if ($akun): ?>
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($akun['id']); ?>">
                <label for="username">Username:</label>
                <input type="text" name="username" value="<?php echo htmlspecialchars($akun['username']); ?>">
                <?php if (isset($error['username'])): ?>
                    <div class="error-message" style="color: red; margin-bottom: 8px;"><?php echo $error['username']; ?></div>
                <?php endif; ?>
                <label for="password">Password (kosongkan jika tidak diubah):</label>
                <input type="password" name="password">
                <label for="role">Role:</label>
                <select name="role" id="role" onchange="toggleRoleInputs()" required>
                    <option value="admin" <?php echo ($akun['role'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
                    <option value="dosen" <?php echo ($akun['role'] === 'dosen') ? 'selected' : ''; ?>>Dosen</option>
                    <option value="mahasiswa" <?php echo ($akun['role'] === 'mahasiswa') ? 'selected' : ''; ?>>Mahasiswa</option>
                </select>
                <div id="dosen_id_input" class="conditional-input">
                    <label for="dosen_id">Dosen ID:</label>
                    <input type="text" name="dosen_id" value="<?php echo htmlspecialchars($akun['dosen_id'] ?? ''); ?>">
                    <?php if (isset($error['dosen_id'])): ?>
                        <div class="error-message"><?php echo $error['dosen_id']; ?></div>
                    <?php endif; ?>
                </div>
                <div id="mahasiswa_id_input" class="conditional-input">
                    <label for="mahasiswa_id">Mahasiswa ID:</label>
                    <input type="text" name="mahasiswa_id" value="<?php echo htmlspecialchars($akun['mahasiswa_id'] ?? ''); ?>">
                    <?php if (isset($error['mahasiswa_id'])): ?>
                        <div class="error-message"><?php echo $error['mahasiswa_id']; ?></div>
                    <?php endif; ?>
                </div>
                <button type="submit" name="edit" style="margin-bottom: 0px">Update</button>
                <?php else: ?>
                <p class="error">Data akun tidak dapat ditemukan.</p>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
