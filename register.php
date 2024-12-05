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

// Proses registrasi
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $id = null;

    // Tentukan dosen_id atau mahasiswa_id berdasarkan role
    if ($role == 'dosen') {
        $id = $_POST['dosen_id']; // Ambil dosen_id
    } elseif ($role == 'mahasiswa') {
        $id = $_POST['mahasiswa_id']; // Ambil mahasiswa_id
    }

    // Hash password dengan bcrypt
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Simpan username, hashed password, role, dan id (dosen_id atau mahasiswa_id) ke database
    $sql = "INSERT INTO akun (username, password, role, dosen_id, mahasiswa_id) VALUES (?, ?, ?, ?, ?)";
    $params = array($username, $hashedPassword, $role, ($role == 'dosen' ? $id : null), ($role == 'mahasiswa' ? $id : null));

    // Eksekusi query
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt) {
        echo "<p class='success'>Registrasi berhasil!</p>";
    } else {
        echo "<p class='error'>Terjadi kesalahan saat registrasi.</p>";
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
    <title>Form Registrasi</title>
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
    </style>
    <script>
        // Menampilkan input dosen_id atau mahasiswa_id berdasarkan role yang dipilih
        function toggleRoleInputs() {
            var role = document.getElementById('role').value;
            document.getElementById('dosen_id').style.display = (role == 'dosen') ? 'block' : 'none';
            document.getElementById('mahasiswa_id').style.display = (role == 'mahasiswa') ? 'block' : 'none';
        }
    </script>
</head>
<body>
    <div class="form-container">
        <h1>Form Registrasi</h1>
        <form method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" required><br>
            
            <label for="password">Password:</label>
            <input type="password" name="password" required><br>
            
            <label for="role">Role:</label>
            <select name="role" id="role" onchange="toggleRoleInputs()" required>
                <option value="admin">Admin</option>
                <option value="dosen">Dosen</option>
                <option value="mahasiswa">Mahasiswa</option>
            </select><br>

            <div id="dosen_id" style="display:none;">
                <label for="dosen_id">Dosen ID:</label>
                <input type="number" name="dosen_id"><br>
            </div>

            <div id="mahasiswa_id" style="display:none;">
                <label for="mahasiswa_id">Mahasiswa ID:</label>
                <input type="number" name="mahasiswa_id"><br>
            </div>
            
            <button type="submit" name="register">Register</button>
        </form>
    </div>
</body>
</html>
