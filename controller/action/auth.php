<?php  
include('../lib/Session.php'); 
include('../lib/Connection.php');

$session = new Session(); 

$connection = new Connection();
$conn = $connection->connect();

$act = isset($_GET['act']) ? strtolower($_GET['act']) : ''; 

if ($act == 'login') { 
    $username = $_POST['username']; 
    $password = $_POST['password'];

    // Buat instance koneksi
    $conn = new Connection();
    $db = $conn->connect();  // Mendapatkan koneksi ke database SQL Server

    if ($db) {
        // Query untuk mencari username di tabel 'akun' menggunakan SQL Server
        $sql = "SELECT * FROM akun WHERE username = ?";
        $stmt = sqlsrv_query($db, $sql, array($username));
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        $data = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

        // Jika data pengguna ditemukan
        if ($data) {
            // Verifikasi password yang sudah di-hash
            if (password_verify($password, $data['password'])) {
                // Set session untuk login
                $session->set('is_login', true); 
                $session->set('username', $data['username']); 
                $session->set('role', $data['role']); 
                $session->set('id', $data['id']);
                $session->set('dosen_id', $data['dosen_id']);
                $session->set('mahasiswa_id', $data['mahasiswa_id']);
                $session->commit(); 

                // Redirect ke dashboard yang sesuai berdasarkan role pengguna
                switch ($data['role']) {
                    case 'admin':
                        header('Location: ../../pages/admin/admin_dashboard.php?page=dashboard', false);
                        break;
                    case 'dosen':
                        header('Location: ../../pages/dosen/dosen_dashboard.php', false);
                        break;
                    case 'mahasiswa':
                        header('Location: ../../pages/mahasiswa/mahasiswa_dashboard.php', false);
                        break;
                    default:
                        // Redirect default jika role tidak dikenali
                        header('Location: ../../index.php', false); 
                        break;
                }
            } else { 
                // Jika password salah
                $session->setFlash('status', false); 
                $session->setFlash('message', 'Password yang Anda masukkan salah.'); 
                $session->commit(); 
                header('Location: ../../login.php', false); 
            }
        } else {
            // Jika username tidak ditemukan
            $session->setFlash('status', false); 
            $session->setFlash('message', 'Username tidak ditemukan.'); 
            $session->commit(); 
            header('Location: ../../login.php', false); 
        }

        // Tutup resource SQL Server
        sqlsrv_free_stmt($stmt);
    } else {
        die("Koneksi ke database gagal.");
    }

    // Tutup koneksi
    $conn->close();

} else if ($act == 'logout') { 
    // Clear semua session saat logout
    $session->deleteAll(); 

    // Redirect ke halaman login setelah logout
    header('Location: ../../login.php', false);
}
?>
