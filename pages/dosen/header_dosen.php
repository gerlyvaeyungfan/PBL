<?php

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'dosen') {
    header('Location: dosen_dashboard.php');
    exit;
}
if (isset($_SESSION['dosen_id'])) {
    $dosen_id = intval($_SESSION['dosen_id']);
    }
// Logika untuk memuat konten sesuai dengan parameter "page"
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        case 'lapor_pelanggaran':
            ?>
            <div class="header1" style="background-color: #889CFE; padding: 10px 10px; height: 60px; display: flex; align-items: center; max-width: 100%; box-sizing: border-box;">
                <h1 style="margin-left: 10px; font-size: 20px; color: #353333; margin-right: 10px; white-space: nowrap;">Melaporkan Pelanggaran Mahasiswa</h1>
            </div><?php
            break;
        case 'cek_laporan':
            ?>
            <div class="header1" style="background-color: #889CFE; padding: 10px 10px; height: 60px; display: flex; align-items: center; max-width: 100%; box-sizing: border-box;">
                <h1 style="margin-left: 10px; font-size: 20px; color: #353333; margin-right: 10px; white-space: nowrap;">Cek Laporan Pelanggaran Mahasiswa</h1>
            </div><?php
            break;

        case 'dashboard':
            ?>
            <div class="header1" style="background-color: #889CFE; padding: 10px 10px; height: 60px; display: flex; align-items: center; max-width: 100%; box-sizing: border-box;">
                <h1 style="margin-left: 10px; font-size: 20px; color: #353333; margin-right: 10px; white-space: nowrap;">Profile Dosen</h1>
            </div><?php
            break;
    }
} else if (!isset($_GET['page'])) {
    ?><div class="header1" style="background-color: #889CFE; padding: 10px 10px; height: 60px; display: flex; align-items: center; max-width: 100%; box-sizing: border-box;">
<h1 style="margin-left: 10px; font-size: 20px; color: #353333; margin-right: 10px; white-space: nowrap;">Profile Dosen</h1>
</div><?php
}
?>