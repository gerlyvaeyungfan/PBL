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

// Proses hapus akun
if (isset($_POST['hapus'])) {
    $id = $_POST['id'];

    // Proses penghapusan akun
    $sql = "DELETE FROM akun WHERE id = ?";
    $params = array($id);

    // Eksekusi query
    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
        echo "Error: " . sqlsrv_errors();
    } else {
        header('Location: admin_dashboard.php?page=daftar_akun');  // Redirect ke halaman sukses
        exit;  // Pastikan tidak ada kode lebih lanjut yang dijalankan
    }

}
// Ambil data akun untuk konfirmasi penghapusan
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM akun WHERE id = ?";
    $params = array($id);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt && sqlsrv_has_rows($stmt)) {
        $akun = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    } else {
        header('Location: ../admin_dashboard.php?page=daftar_akun');
        exit;
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
    <title>Hapus Akun</title>
    <style>
        
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
</head>
<body>
<div style="background-color: #ffffff; padding: 20px; margin: 0; border-radius: 8px; width: 100%; height: 100%; max-height: 460px; overflow-y: auto; box-sizing: border-box; display: flex; justify-content: center; align-items: center;">
    <div class="form-container" style="background-color: #ffffff; padding: 20px; padding-bottom: 30px; margin: 0; border-radius: 8px; width: 100%; max-width: 400px; box-sizing: border-box;">
        <h1>Hapus Akun</h1>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $akun['id']; ?>">

            <p>Anda yakin ingin menghapus akun dengan username: <strong><?php echo $akun['username']; ?></strong>?</p>
            
            <button type="submit" name="hapus">Hapus Akun</button>
        </form>
    </div>
</div>

</body>
</html>
