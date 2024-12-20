<?php
include('controller/lib/Session.php');
$session = new Session();

// Cek apakah pengguna sudah login
if ($session->get('is_login') === true) {
    $role = $session->get('role');
    $dosen_id = $session->get('dosen_id');
    $mahasiswa_id = $session->get('mahasiswa_id');
    // Arahkan berdasarkan role
    if ($role === 'admin') {
        header('Location: pages/admin/admin_dashboard.php?page=dashboard'); // Arahkan ke halaman dashboard admin
    } else if ($role === 'dosen') {
        header('Location: pages/dosen/dosen_dashboard.php'); // Arahkan ke halaman dashboard user
    } else if ($role === 'mahasiswa') {
        header('Location: pages/mahasiswa/mahasiswa_dashboard.php'); // Arahkan ke halaman dashboard admin
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page - Sistem Informasi Tata Tertib</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #6610f2, #007bff);
        }

        .container {
            display: flex;
            width: 900px;
            background: #fff;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            overflow: hidden;
        }

        .image-container {
            flex: 1;
            overflow: hidden;
        }

        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .login-container {
            flex: 1;
            padding: 40px;
            background: linear-gradient(135deg, #007bff, #6610f2);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-container h1 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .alert {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .input-group input {
            width: calc(100% - 40px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px 0 0 5px;
            outline: none;
        }

        .input-group .input-group-text {
            width: 40px;
            background: #007bff;
            color: #fff;
            text-align: center;
            border: 1px solid #007bff;
            border-radius: 0 5px 5px 0;
        }

        .row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 10px;
        }

        .btn {
            background: #007bff;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn:hover {
            background: #0056b3;
        }

        .logo {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .logo img {
            height: 50px;
            margin: 0 10px;
        }

        label {
            font-size: 14px;
        }

        .fa-lock {
            padding: 9.5px;
        }
        .fa-user {
            padding: 9.5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="image-container">
            <img src="view/img/Gambarbg.jpeg" alt="Background Image">
        </div>
        <div class="login-container">
            <h1 style="color: white;">Sistem Informasi Tata Tertib - JTI Polinema</h1>
            <?php
                $status = $session->getFlash('status');
                if ($status === false) {
                    $message = $session->getFlash('message');
                    echo '<div class="alert">' . $message . '</div>';
                }
            ?>
            <form action="controller/action/auth.php?act=login" method="post" id="form-login">
                <div class="input-group">
                    <input type="text" name="username" placeholder="Username" required>
                    <div class="input-group-text">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
                <div class="input-group">
                    <input type="password" name="password" placeholder="Password" required>
                    <div class="input-group-text">
                        <i class="fas fa-lock"></i>
                    </div>
                </div>
                <div class="row">
                    <div style="color: white;" class="col-8">
                        <label>
                            <input type="checkbox" id="remember">
                            Remember Me
                        </label>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn">Sign In</button>
                    </div>
                </div>
            </form>
            <div class="logo">
                <img src="view/img/logo/logo-polinema.png" alt="Logo Poltek">
                <img src="view/img/logo/logo-jti.png" alt="Logo JTI">
            </div>
        </div>
    </div>
</body>

</html>
