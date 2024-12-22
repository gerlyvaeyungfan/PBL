<?php
// Memulai sesi di header.php sehingga hanya dimulai sekali
if (session_status() == PHP_SESSION_NONE) {
    session_start();

}

// Cek apakah pengguna sudah login dan memiliki role 'admin'
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'dosen') {
    header('Location: ../../login.php'); // Arahkan ke halaman login jika bukan admin
    exit;
}

// Menambahkan fitur logout
if (isset($_GET['logout'])) {
    session_destroy();  // Hapus sesi
    header('Location: ../../../PBL'); // Arahkan ke halaman login setelah logout
    exit;
}
if (isset($_SESSION['dosen_id'])) {
    $dosen_id = intval($_SESSION['dosen_id']);
    }

// Koneksi ke database
include('../../controller/lib/Connection.php');

$connection = new Connection();
$conn = $connection->connect();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SisITaTib JTI Polinema</title>
    <link rel="stylesheet" href="../../view/style/Admincss.css">
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
    <!-- Sidebar -->
    <?php include('../navbar.php');?>

    <div class="container">

        <!-- Sidebar -->
        <?php include('sidebar_dosen.php');?>
        <?php include('../navbar.php');?>
        <!-- Main Content -->
        <div class="main-content">
        <?php include('header_dosen.php');

            if (isset($_GET['page'])) {
                $page = $_GET['page'];
                switch ($page) {
                    case 'lapor_pelanggaran':
                        include('melaporkan_pelanggaran.php');
                        break;
                        
                    case 'cek_laporan':
                        include('cek_laporan.php');
                        break;
                    case 'detail_pelanggaran';
                        include('detail_pelanggaran.php');
                        break;
                    case 'dashboard':
                    ?>
                            <div style="background-color: #ffffff; padding: 20px; padding-bottom: 30px; margin: 0; border-radius: 8px; width: calc(100% - 0px); height: 100%; max-height: 460px; overflow-y: auto; box-sizing: border-box;">
                            <?php
                            if (isset($_SESSION['username']) && isset($_SESSION['role'])) {
                                $username = $_SESSION['username'];
                                $role = $_SESSION['role'];
                        
                                // Tentukan query berdasarkan role
                                $query_foto = "";
                                if ($role == 'dosen') {
                                    $query_foto = "SELECT * FROM dosen WHERE id = (SELECT dosen_id FROM akun WHERE username = ?)";
                                }
                        
                                // Eksekusi query hanya jika valid
                                if (!empty($query_foto)) {
                                    $params = array($username);
                                    $stmt_foto = sqlsrv_query($conn, $query_foto, $params);
                        
                                    // Validasi hasil query
                                    if ($stmt_foto === false) {
                                        die(print_r(sqlsrv_errors(), true));
                                    }
                        
                                    // Ambil data jika query berhasil
                                    if (sqlsrv_has_rows($stmt_foto)) {
                                        $foto = sqlsrv_fetch_array($stmt_foto, SQLSRV_FETCH_ASSOC);
                        
                                        // Tampilkan data
                                        echo '<h2>Informasi ' . ucfirst($role) . '</h2>';
                                        echo '<img src="' . htmlspecialchars($foto['foto_dosen'] ?? 'default.png') . '" alt="Foto ' . ucfirst($role) . '" style="width:100px; height:auto;">';

                            // Tampilkan biodata berdasarkan role
                            echo '<table>';
                            if ($role == 'dosen') {
                                echo '<br><tr><td>Nama</td><td>: ' . htmlspecialchars($foto['nama']) . '</td></tr>';
                                echo '<tr><td>NIDN</td><td>: ' . htmlspecialchars($foto['nidn']) . '</td></tr>';
                                echo '<tr><td>Jenis Kelamin</td><td>: ' . htmlspecialchars($foto['jk']) . '</td></tr>';
                                echo '<tr><td>Alamat</td><td>: ' . htmlspecialchars($foto['alamat']) . '</td></tr>';
                                echo '<tr><td>Email</td><td>: ' . htmlspecialchars($foto['email']) . '</td></tr>';
                            }
                        }
                            echo '</table></div>';

                        } else {
                            echo '<p>Data tidak ditemukan.</p>';
                        }
                    } else {
                        echo '<p>Query tidak valid.</p>';
                    }
                    
                        break;
                    default:
                        echo '<h2>Halaman tidak ditemukan</h2>';
                        break;
            }
        } else if (!isset($_GET['page'])){
            ?>
                <div style="
                background-color: #ffffff;
                padding: 20px; 
                padding-bottom: 30px; 
                margin: 0; 
                border-radius: 8px; 
                width: calc(100% - 0px); 
                height: 100%;
                box-sizing: border-box;">
            <?php
                if (isset($_SESSION['username']) && isset($_SESSION['role'])) {
                    $username = $_SESSION['username'];
                    $role = $_SESSION['role'];
            
                    // Tentukan query berdasarkan role
                    $query_foto = "";
                    if ($role == 'dosen') {
                        $query_foto = "SELECT * FROM dosen WHERE id = (SELECT dosen_id FROM akun WHERE username = ?)";
                    }
            
                    // Eksekusi query hanya jika valid
                    if (!empty($query_foto)) {
                        $params = array($username);
                        $stmt_foto = sqlsrv_query($conn, $query_foto, $params);
            
                        // Validasi hasil query
                        if ($stmt_foto === false) {
                            die(print_r(sqlsrv_errors(), true));
                        }
            
                        // Ambil data jika query berhasil
                        if (sqlsrv_has_rows($stmt_foto)) {
                            $foto = sqlsrv_fetch_array($stmt_foto, SQLSRV_FETCH_ASSOC);
            
                            // Tampilkan data
                            echo '<h2>Informasi ' . ucfirst($role) . '</h2>';
                            echo '<img src="' . htmlspecialchars($foto['foto_dosen'] ?? 'default.png') . '" alt="Foto ' . ucfirst($role) . '" style="width:100px; height:auto;">';

                // Tampilkan biodata berdasarkan role
                echo '<table>';
                if ($role == 'dosen') {
                    echo '<br><tr><td>Nama</td><td>: ' . htmlspecialchars($foto['nama']) . '</td></tr>';
                    echo '<tr><td>NIDN</td><td>: ' . htmlspecialchars($foto['nidn']) . '</td></tr>';
                    echo '<tr><td>Jenis Kelamin</td><td>: ' . htmlspecialchars($foto['jk']) . '</td></tr>';
                    echo '<tr><td>Alamat</td><td>: ' . htmlspecialchars($foto['alamat']) . '</td></tr>';
                    echo '<tr><td>Email</td><td>: ' . htmlspecialchars($foto['email']) . '</td></tr>';
                }
            }
                echo '</table></div>';

            } else {
                echo '<p>Data tidak ditemukan.</p>';
            }
        } else {
            header('Location: ../../login.php');
        }
        }
            ?>
        </div>
    </div>
</body>

</html>

<?php
// Mengakhiri output buffering dan mengirimkan output ke browser
ob_end_flush();
?>