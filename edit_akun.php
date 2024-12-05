<?php
session_start();

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

// Proses edit akun
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $dosen_id = $_POST['dosen_id'] ?? null;
    $mahasiswa_id = $_POST['mahasiswa_id'] ?? null;

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
        echo "<p class='success'>Data akun berhasil diperbarui!</p>";
    } else {
        echo "<p class='error'>Terjadi kesalahan saat memperbarui data akun.</p>";
    }
}

// Ambil data akun
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM akun WHERE id = ?";
    $params = array($id);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt && sqlsrv_has_rows($stmt)) {
        $akun = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    } else {
        die("<p class='error'>Data akun tidak ditemukan.</p>");
    }
}

// Tutup koneksi
sqlsrv_close($conn);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Akun</title>
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
        .form-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        h1 {
            text-align: center;
            color: #004080;
        }
        label {
            color: #004080;
            font-weight: bold;
        }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 16px;
            border: 1px solid #cce7ff;
            border-radius: 4px;
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
    </style>
    <script>
        // Fungsi untuk menampilkan input berdasarkan role
        function toggleRoleInputs() {
            var role = document.getElementById('role').value;
            var dosenInput = document.getElementById('dosen_id_input');
            var mahasiswaInput = document.getElementById('mahasiswa_id_input');

            // Menampilkan dosen_id untuk semua role (admin dan dosen), tetapi hanya diizinkan diubah untuk role "dosen"
            if (role == 'dosen' || role == 'admin') {
                dosenInput.style.display = 'block';
                mahasiswaInput.style.display = 'none';
            } else if (role == 'mahasiswa') {
                mahasiswaInput.style.display = 'block';
                dosenInput.style.display = 'none';
            } else {
                dosenInput.style.display = 'none';
                mahasiswaInput.style.display = 'none';
            }
        }

        // Pastikan input yang relevan ditampilkan saat halaman dimuat
        window.onload = function() {
            toggleRoleInputs();
        };
    </script>
</head>
<body>
    <div class="form-container">
        <h1>Edit Akun</h1>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $akun['id']; ?>">
            
            <label for="username">Username:</label>
            <input type="text" name="username" value="<?php echo $akun['username']; ?>" required><br>
            
            <label for="password">Password (kosongkan jika tidak diubah):</label>
            <input type="password" name="password"><br>
            
            <label for="role">Role:</label>
            <select name="role" id="role" onchange="toggleRoleInputs()" required>
                <option value="admin" <?php echo ($akun['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                <option value="dosen" <?php echo ($akun['role'] == 'dosen') ? 'selected' : ''; ?>>Dosen</option>
                <option value="mahasiswa" <?php echo ($akun['role'] == 'mahasiswa') ? 'selected' : ''; ?>>Mahasiswa</option>
            </select><br>
            
            <!-- Input untuk dosen_id jika role = dosen atau admin -->
            <div id="dosen_id_input" class="conditional-input">
                <label for="dosen_id">Dosen ID:</label>
                <input type="text" name="dosen_id" value="<?php echo $akun['dosen_id']; ?>"><br>
            </div>
            
            <!-- Input untuk mahasiswa_id jika role = mahasiswa -->
            <div id="mahasiswa_id_input" class="conditional-input">
                <label for="mahasiswa_id">Mahasiswa ID:</label>
                <input type="text" name="mahasiswa_id" value="<?php echo $akun['mahasiswa_id']; ?>"><br>
            </div>
            
            <button type="submit" name="edit">Update</button>
        </form>
    </div>
</body>
</html>
