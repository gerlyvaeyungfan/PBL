<?php
include('Model.php');
class UserModel extends Model{
    protected $db;
    protected $table = 'akun';
    protected $driver;
    public function __construct(){
        include('../controller/lib/Connection.php');
        $this->db = $db;
        $this->driver = $use_driver;
    }

    public function login($username, $password){
        if($this->driver == 'mysql'){
            // query untuk mengambil data berdasarkan username
            $query = $this->db->prepare("select * from {$this->table} where username = ?");
            $query->bind_param('s', $username);
            $query->execute();
            $result = $query->get_result()->fetch_assoc();
            
            // cek apakah user ditemukan dan password cocok
            if ($result && password_verify($password, $result['password'])) {
                return $result; // login sukses, mengembalikan data user
            } else {
                return false; // login gagal
            }
        } else {
            // query untuk mengambil data berdasarkan username
            $query = sqlsrv_query($this->db, "select * from {$this->table} where username = ?", [$username]);
            $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
            
            // cek apakah user ditemukan dan password cocok
            if ($result && password_verify($password, $result['password'])) {
                return $result; // login sukses, mengembalikan data user
            } else {
                return false; // login gagal
            }
        }
    }
    
    public function insertData($data){
        if($this->driver == 'mysql'){
// prepare statement untuk query insert
            $query = $this->db->prepare("insert into {$this->table} (role, username, password) values(?,?,?,?)");
// binding parameter ke query, "s" berarti string, "ss" berarti dua string
            $query->bind_param('ssss', $data['username'], $data['role'],
                password_hash($data['password'], PASSWORD_DEFAULT));
// eksekusi query untuk menyimpan ke database
            $query->execute();
        } else {
// eksekusi query untuk menyimpan ke database
            sqlsrv_query($this->db, "insert into {$this->table} (role, username, password) values(?,?,?,?)", array($data['username'], $data['nama'], $data['level'],
                password_hash($data['password'], PASSWORD_DEFAULT)));
        }
    }
    public function getData(){
        if($this->driver == 'mysql'){
// query untuk mengambil data dari tabel
            return $this->db->query("select * from {$this->table} ")->fetch_all(MYSQLI_ASSOC);
} else {
// query untuk mengambil data dari tabel
            $query = sqlsrv_query($this->db, "select * from {$this->table}");
            $data = [];
            while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){
                $data[] = $row;
            }
            return $data;
        }
    }
    public function getDataById($id){
        if($this->driver == 'mysql'){
// query untuk mengambil data berdasarkan id
            $query = $this->db->prepare("select * from {$this->table} where id = ?");
// binding parameter ke query "i" berarti integer. Biar tidak kena SQL Injection
            $query->bind_param('i', $id);
// eksekusi query
            $query->execute();
// ambil hasil query
            return $query->get_result()->fetch_assoc();
        } else {
// query untuk mengambil data berdasarkan id
            $query = sqlsrv_query($this->db, "select * from {$this->table} where id =
?", [$id]);
// ambil hasil query
            return sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
        }
    }
    public function updateData($id, $data){
        if($this->driver == 'mysql'){
// query untuk update data
            $query = $this->db->prepare("update {$this->table} set role = ?, username = ?,
password = ? where id = ?");
// binding parameter ke query
            $query->bind_param('ssssi', $data['username'], $data['role'],
                password_hash($data['password'], PASSWORD_DEFAULT), $id);
// eksekusi query
            $query->execute();
        } else {
// query untuk update data
            sqlsrv_query($this->db, "update {$this->table} set username = ?, role = ?, password = ? where id = ?", [$data['username'], $data['role'],
                password_hash($data['password'], PASSWORD_DEFAULT), $id]);
        }
    }
    public function deleteData($id){
        if($this->driver == 'mysql'){
// query untuk delete data
            $query = $this->db->prepare("delete from {$this->table} where id = ?");
            // binding parameter ke query
            $query->bind_param('i', $id);
// eksekusi query
            $query->execute();
        } else {
// query untuk delete data
            sqlsrv_query($this->db, "delete from {$this->table} where id = ?", [$id]);
        }
    }
    public function getSingleDataByKeyword($column, $keyword){
        if($this->driver == 'mysql'){
            // query untuk mengambil data berdasarkan id
            $query = $this->db->prepare("select * from {$this->table} where {$column} = ?");
            // binding parameter ke query "s" berarti string
            $query->bind_param('s', $keyword);
            
            // eksekusi query
            $query->execute();
            
            // Cek apakah query berhasil
            if ($query === false) {
                die("Query error: " . $this->db->error); // Tampilkan kesalahan query MySQL
            }
            
            // Mengambil hasil query
            return $query->get_result()->fetch_assoc();
        } else {
            // query untuk mengambil data berdasarkan id
            $query = sqlsrv_query($this->db, "select * from {$this->table} where {$column} = ?", [$keyword]);
            
            // Cek apakah query berhasil
            if ($query === false) {
                die("Query error: " . print_r(sqlsrv_errors(), true)); // Tampilkan kesalahan query SQL Server
            }
            
            // Ambil hasil query
            return sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
        }
    }
    
}