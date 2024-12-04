<?php  
include('../lib/Session.php'); 
include('../lib/Connection.php'); 

$session = new Session(); 

$act = isset($_GET['act'])? strtolower($_GET['act']) : ''; 

if($act == 'login'){ 

    $username = $_POST['username']; 
    $password = $_POST['password'];
    
    include('../../model/UserModel.php'); 
    // digunakan untuk query user 
    $user = new UserModel(); 
    $data = $user->getSingleDataByKeyword('username', $username);

    // Jika data ditemukan, lakukan verifikasi password
    if ($data) {
        if (password_verify($password, $data['password'])) { 
            // Set session untuk login
            $session->set('is_login', true); 
            $session->set('username', $data['username']); 
            $session->set('role', $data['role']); 
            $session->commit(); 

            header('Location: ../../index.php', false); 
        } else { 
            // Jika password salah
            $session->setFlash('status', false); 
            $session->setFlash('message', 'Username dan password salah.'); 
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
    
} else if($act == 'logout'){ 

    $session->deleteAll(); 

    header('Location: ../../login.php', false);
}
