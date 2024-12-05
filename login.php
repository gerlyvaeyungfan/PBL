<?php
include('controller/lib/Session.php');
$session = new Session();

// Cek apakah pengguna sudah login
if ($session->get('is_login') === true) {
    $role = $session->get('role');
    // Arahkan berdasarkan role
    if ($role === 'admin') {
        header('Location: pages/admin_dashboard.php'); // Arahkan ke halaman dashboard admin
    } else if ($role === 'dosen') {
        header('Location: pages/dosen_dashboard.php'); // Arahkan ke halaman dashboard user
    } else if ($role === 'mahasiswa') {
        header('Location: pages/mahasiswa_dashboard.php'); // Arahkan ke halaman dashboard admin
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="view/style/logincss.css">
</head>

<body>
    <div class="container">
        <div class="image-container">
            <img src="view/img/Gambarbg.jpeg">
        </div>
        <div class="login-container">
            <h1>LOGIN PAGE</h1>
            <?php
                $status = $session->getFlash('status');
                if ($status === false) {
                    $message = $session->getFlash('message');
                    echo '<div class="alert alert-warning">' . $message . 
                         '<button type="button" class="close" data-dismiss="alert" arialabel="Close"><span aria-hidden="true">&times;</span></button></div>';
                }
            ?>
            <form action="controller/action/auth.php?act=login" method="post" id="form-login">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">Remember Me</label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <div class="logo">
                <img src="view/img/poltek.jpg" alt="Logo 1">
                <img src="view/img/jti.png" alt="Logo 2">
            </div>
        </div>
    </div>
</body>

</html>
