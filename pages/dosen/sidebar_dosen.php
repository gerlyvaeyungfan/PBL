<?php 
if (isset($_SESSION['dosen_id'])) {
    $dosen_id = intval($_SESSION['dosen_id']);
    }
?>
<!DOCTYPE html>
<style>
    .menu table {
        width: 100%;
        border-collapse: collapse;
    }

    .menu td {
        padding: 10px;
        text-align: left;
        cursor: pointer;
        background-color: #889CFE; /* Warna default */
        color: #353333; /* Warna teks default */
        font-size: 12px;
        transition: all 0.3s ease;
    }

    /* Menonaktifkan hover dan cursor untuk elemen tertentu */
    .menu td.no-hover {
        pointer-events: none; /* Menonaktifkan interaksi (klik) */
        cursor: default; /* Menonaktifkan cursor pointer */
        background-color: #889CFE; /* Warna non-aktif */
        color: #353333; /* Menyesuaikan warna teks */
        transition: none; /* Menonaktifkan transisi */
    }

    /* Warna saat elemen aktif */
    .menu td.active {
        background-color: #4458a5; /* Warna aktif */
        color: #FFFFFF; /* Warna teks aktif */
        font-weight: bold;
    }

    .menu td a {
        text-decoration: none;
        color: inherit;
        font-size: 12px;
        display: block;
        width: 100%;
        height: 100%;
    }
</style>

<div class="sidebar" style="background-color: #F4F2EC; color: #696161; width: 200px; display: flex; flex-direction: column; align-items: flex-start; padding: 0px; margin-top: 60px; position: fixed; top: 0; left: 0; height: 100%; z-index: 1000;">

    <div class="logo" style="font-size: 24px; font-weight: bold; margin-bottom: 20px; display: flex; align-items: center;"></div>
    <div class="user-info" style="display: flex; align-items: center; padding: 10px; gap: 20px;">
        <img src="../../view/ProfileDosen/dosen.png" alt="Foto Dosen" style="width: 60px; height: 60px; margin-left: 0px; margin-top: 10px;">
        <table style="font-size: 12px; color: #302D2D;">
            <tr>
                <td>Nama Dosen</td>
            </tr>
        </table>
    </div>

    <div class="menu" style="width: 100%; margin-top: 5px;">
        <p style="font-size: 14px; font-weight: bold; margin-left: 10px; color: #353333;">MAIN MENU</p>
        <table>
            <tr>
                <td class="no-hover">Periode 2024/2025</td>
            </tr>
            <tr>
                <td>
                    <a href="dosen_dashboard.php?page=dashboard">Profil Anda</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="dosen_dashboard.php?page=lapor_pelanggaran">Melaporkan Pelanggaran</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="dosen_dashboard.php?page=cek_laporan">Cek Laporan</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="?logout=true">Logout</a>
                </td>
            </tr>
        </table>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const menuItems = document.querySelectorAll('.menu td');

        menuItems.forEach(item => {
            item.addEventListener('click', function () {
                // Pastikan klik pada <td> juga memicu <a>
                const link = this.querySelector('a');
                if (link) {
                    link.click();
                }

                // Hapus kelas 'active' dari semua elemen
                menuItems.forEach(i => i.classList.remove('active'));

                // Tambahkan kelas 'active' hanya ke elemen yang diklik
                this.classList.add('active');
            });
        });

        // Menandai elemen aktif berdasarkan URL (opsional)
        const currentUrl = window.location.href;
        menuItems.forEach(item => {
            const link = item.querySelector('a');
            if (link && currentUrl.includes(link.getAttribute('href'))) {
                item.classList.add('active');
            }
        });
    });
</script>

<!-- Content container for the page -->
<div style="margin-left: 200px; padding: 0px;">
    <!-- Other content goes here -->
</div>
