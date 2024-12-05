<?php  
include('controller/lib/Session.php'); 

$session = new Session(); 

// Menghapus semua sesi saat logout
$session->deleteAll(); 

// Redirect ke halaman login setelah logout
header('Location: login.php', false); 
exit();
?>
