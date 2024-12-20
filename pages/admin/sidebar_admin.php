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
        transition: all 0.0s ease;
        background-color: transparent; /* Default */
    }

    .menu a:hover {
        background: linear-gradient(190deg, rgb(227, 221, 255), rgb(2, 10, 125));
        color: #FFFFFF;
        font-weight: bold;
        border-radius: 15px; /* Tambahkan ini untuk membuat lengkungan */
        padding: 10px 10px;
    }

    /* Styling untuk link aktif */
    .menu a.active {
        background: linear-gradient(190deg, rgb(227, 221, 255), rgb(2, 10, 125));
        color: #FFFFFF;
        font-weight: bold;
        border-radius: 15px;
    }

    .menu .no-hover {
        pointer-events: none; /* Nonaktifkan klik */
        color: rgb(67, 87, 185);
        font-size: 14px;
        margin-left: 15px;
        margin-bottom: 10px;
        font-weight: bold;
    }
</style>

<div class="sidebar" style="background: linear-gradient(160deg, rgb(227, 221, 255), rgb(2, 10, 125)); color: #696161; width: 200px; display: flex; flex-direction: column; align-items: flex-start; padding: 0px; margin-top: 60px; position: fixed; top: 0; left: 0; height: 100%; z-index: 1000;">

    <div class="logo" style="font-weight: bold; margin-bottom: 40px; display: flex; align-items: center; justify-content: center;">
        <img src="../../view/img/logo/logo-sisitatib.png" alt="Logo" style="width: 200px; height: 32px; margin-left: 0px; margin-top: 8px; border: 0px;">
    </div>

    <div class="menu">
        
        <div class="no-hover">Periode 2024/2025</div>
        <p>MAIN MENU</p>
        <a href="admin_dashboard.php?page=pelanggaran">Riwayat Pelanggaran</a>
        <a href="admin_dashboard.php?page=data_mahasiswa">Data Mahasiswa</a>
        <a href="admin_dashboard.php?page=data_dosen">Data Dosen</a>
        <a href="admin_dashboard.php?page=daftar_akun">Data Akun</a>
        <a href="admin_dashboard.php?page=data_pelanggaran">Data Pelanggaran</a>
        <a href="admin_dashboard.php?page=data_sanksi">Data Sanksi</a>
        <a href="admin_dashboard.php?page=dashboard">Profil Anda</a>
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

<!-- Content container for the page -->
<div style="margin-left: 200px; padding: 0px;">
    <!-- Other content goes here -->
</div>
