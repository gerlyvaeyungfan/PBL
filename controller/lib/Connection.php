<?php
// Class Connection
class Connection {
    private $use_driver = 'sqlsrv'; // Menentukan driver yang digunakan (sqlsrv)
    private $host = 'DESKTOP-53O8L0G'; // Nama server
    private $username = ''; // Username untuk koneksi database
    private $password = ''; // Password untuk koneksi database
    private $database = 'tata_tertib'; // Nama database yang akan digunakan
    private $conn; // Menyimpan resource koneksi

    // Method untuk menghubungkan ke database
    public function connect() {
        // Mengecek apakah driver yang digunakan adalah sqlsrv
        if ($this->use_driver == 'sqlsrv') {
            $connectionOptions = [
                'Database' => $this->database, // Nama database
                'Uid' => $this->username, // Username
                'PWD' => $this->password, // Password
            ];
            // Melakukan koneksi
            $this->conn = sqlsrv_connect($this->host, $connectionOptions);
            
            // Mengecek apakah koneksi berhasil
            if (!$this->conn) {
                die('Koneksi gagal: ' . print_r(sqlsrv_errors(), true));
            }
        } else {
            die('Driver tidak didukung. Gunakan sqlsrv.');
        }
        
        // Mengembalikan resource koneksi yang berhasil
        return $this->conn;
    }

    // Method untuk menutup koneksi
    public function close() {
        if ($this->conn) {
            sqlsrv_close($this->conn); // Menutup koneksi jika ada
        }
    }

    // Optional: Method untuk mengatur konfigurasi koneksi
    public function setConfig($use_driver, $host, $username, $password, $database) {
        $this->use_driver = $use_driver;
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }

    // Method untuk mendapatkan resource koneksi (misalnya digunakan untuk query)
    public function getConnection() {
        return $this->conn;
    }
}

// Penggunaan
$connection = new Connection();
$conn = $connection->connect();

?>
