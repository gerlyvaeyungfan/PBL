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
        background: linear-gradient(190deg, rgb(227, 221, 255), rgb(46, 58, 218));
        color: #FFFFFF;
        font-weight: bold;
        border-radius: 15px;
    }

    /* Styling untuk link aktif */
    .menu a.active {
        background: linear-gradient(190deg, rgb(243, 221, 171), rgb(133, 141, 243));
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
<!--Warna side bar-->
<div class="sidebar" style="background: linear-gradient(160deg, rgb(66,55,205), rgb(55,68,237)); color: #202bc8; width: 200px; margin-top: 60px;  height: 200%; z-index: 1000;">
<!--   /warna side bar-->
    <div class="logo" style="font-weight: bold; margin-bottom: 20px; display: flex; align-items: center; justify-content: center;">
        <img src="../../view/ProfileDosen/dosen.png" alt="Logo" style="width: 70px; height: 70px; margin-top: 10px;">
    </div>

    <div class="menu">
        <div class="no-hover" style="color: black">Periode 2024/2025</div>
        <p>MAIN MENU</p>
        <a href="dosen_dashboard.php?page=lapor_pelanggaran">Melaporkan</a>
        <a href="dosen_dashboard.php?page=cek_laporan">Cek Laporan</a>
        <a href="dosen_dashboard.php?page=dashboard">Profile</a>
        <a href="?logout=true">Logout</a>
    </div>
</div>