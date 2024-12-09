<?php
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

// Proses registrasi
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $id = $_POST['id'];

    // Tentukan dosen_id, mahasiswa_id, atau admin_id berdasarkan role
    $dosen_id = NULL;
    $mahasiswa_id = NULL;

    if ($role === 'dosen') {
        $dosen_id = $id;  // Dosen ID jika role adalah dosen
    } elseif ($role === 'mahasiswa') {
        $mahasiswa_id = $id;  // Mahasiswa ID jika role adalah mahasiswa
    } elseif ($role === 'admin') {
        $dosen_id = $id;  // Admin ID disimpan ke dosen_id
    }

    // Hash password dengan bcrypt
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Pastikan hanya satu nilai yang akan dimasukkan
    $sql = "INSERT INTO akun (username, password, role, dosen_id, mahasiswa_id) VALUES (?, ?, ?, ?, ?)";
    $params = array($username, $hashedPassword, $role, $dosen_id, $mahasiswa_id);

    // Eksekusi query
    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
        echo "Error: " . sqlsrv_errors();
    } else {
        header('Location: admin_dashboard.php?page=daftar_akun');  // Redirect ke halaman sukses
        exit;  // Pastikan tidak ada kode lebih lanjut yang dijalankan
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
            margin-bottom: 16px;
            border: 1px solid #cce7ff;
            border-radius: 4px;
            box-sizing: border-box;
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
        form {
            margin: 0; /* Mengatur margin form menjadi 0 */
            width: 100%; /* Pastikan form memanfaatkan seluruh lebar */
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <div style="background-color: #ffffff; padding: 20px; padding-bottom: 20px; margin: 0; border-radius: 8px; width: 100%; height: 100%; max-height: 460px; overflow-y: auto; box-sizing: border-box;">
        <h2>Form Registrasi</h2>
        <form method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" required><br>
            
            <label for="password">Password:</label>
            <input type="password" name="password" required><br>

            <label for="role">Role:</label>
            <select name="role" id="role" required>
                <option value="admin">Admin</option>
                <option value="dosen">Dosen</option>
                <option value="mahasiswa">Mahasiswa</option>
            </select><br>

            <label for="id">ID (Dosen ID atau Mahasiswa ID):</label>
            <input type="number" name="id" required><br>

            <button type="submit" name="register" style="margin-bottom: 0px;">Register</button>
        </form>
    </div>
</body>
</html>