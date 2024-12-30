<style>
    .menu {
        width: 100%;
        margin-top: 5px;
        padding: 0;
    }


    .menu p {
        font-size: 14px;
        font-weight: bold;
        margin-left: 10px;
        color: rgb(255, 255, 255);
    }

    .menu a {
        display: block;
        padding: 10px 15px;
        border-radius: 15px;
        text-decoration: none;
        color: white;
        font-size: 12px;
        transition: all 0.3s ease;
        background-color: transparent; /* Default */
    }

    .menu a:hover {
        background: linear-gradient(190deg, rgb(227, 221, 255), rgb(2, 10, 125));
        color: #FFFFFF;
        font-weight: bold;
        border-radius: 15px;
    }

    .menu a.active {
        background: linear-gradient(190deg, rgb(227, 221, 255), rgb(2, 10, 125));
        color: #FFFFFF;
        font-weight: bold;
        border-radius: 15px;
    }

    .menu .no-hover {
        pointer-events: none;
        color: rgb(67, 87, 185);
        font-size: 14px;
        margin-left: 15px;
        margin-bottom: 10px;
        font-weight: bold;
    }
</style>
<!--Warna side bar -->
<div class="sidebar" style="background: linear-gradient(160deg, rgb(227, 221, 255), rgb(2, 10, 125)); color: #696161; width: 200px; margin-top: 60px;  height: 110%; z-index: 1000;">
<div class="logo" style="font-weight: bold; margin-bottom: 10px;display:flex; align-items: center; justify-content: center;">
        <img src="../../view/img/logo/logo-sisitatib.png" alt="Logo" style="width: 200px; height: 32px; margin-left: 0px; margin-top: 8px; border: 0px;">
    </div>
    <!--   /warna side bar-->
    <div class="logo" style="font-weight: bold; margin-bottom: 20px; display: flex; align-items: center; justify-content: center; border-radius: 50%;">
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
                    echo '<img src="' . htmlspecialchars($foto['foto_dosen'] ?? 'default.png') . '" alt="Foto ' . ucfirst($role) . '" style="width: 70px; height: 70px; margin-top: 10px; border-radius: 50%;">';
                } else {
                    echo '<img src="default.png" alt="Default Foto" style="width: 60px; height: 60px; margin-top: 10px; border-radius: 50%;">';
                }
            }
        } else {
            echo '<img src="default.png" alt="Default Foto" style="width: 60px; height: 60px; margin-top: 10px;">';
        }
        ?>
    </div>

    <div class="menu">
        <div class="no-hover" style="color: black">Periode 2024/2025</div>
        <p>MAIN MENU</p>
        <a href="dosen_dashboard.php?page=dashboard">Profil</a>
        <a href="dosen_dashboard.php?page=lapor_pelanggaran">Melaporkan</a>
        <a href="dosen_dashboard.php?page=cek_laporan">Cek Laporan</a>
        <a href="?logout=true">Logout</a>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const menuLinks = document.querySelectorAll('.menu a');

        menuLinks.forEach(link => {
            link.addEventListener('click', function () {
                // Hapus kelas 'active' dari semua link
                menuLinks.forEach(i => i.classList.remove('active'));

                // Tambahkan kelas 'active' hanya ke link yang diklik
                this.classList.add('active');
            });
        });

        // Menandai elemen aktif berdasarkan URL (opsional)
        const currentUrl = window.location.href;
        menuLinks.forEach(link => {
            if (currentUrl.includes(link.getAttribute('href'))) {
                link.classList.add('active');
            }
        });
    });
</script>
