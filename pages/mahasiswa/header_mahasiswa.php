<?php

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'mahasiswa') {
    header('Location: mahasiswa_dashboard.php');
    exit;
}
if (isset($_SESSION['mahasiswa_id'])) {
    $dosen_id = intval($_SESSION['mahasiswa_id']);
    }
// Logika untuk memuat konten sesuai dengan parameter "page"
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        case 'pelanggaran':
            ?>
            <div class="header1" style="background-color: #889CFE; padding: 10px 10px; height: 60px; display: flex; align-items: center; max-width: 100%; box-sizing: border-box;">
                <h1 style="margin-left: 200px; font-size: 20px; color: #353333; margin-right: 10px; white-space: nowrap;">Riwayat Pelanggaran</h1>
            </div><?php
            break;
        case 'sanksi':
            ?>
            <div class="header1" style="background-color: #889CFE; padding: 10px 10px; height: 60px; display: flex;  max-width: 100%; box-sizing: border-box;">
                <h1 style="margin-left: 10px; font-size: 20px; color: #353333; margin-right: 10px; white-space: nowrap;">Sanksi Pelanggaran Mahasiswa</h1>
            </div><?php
            break;
        case 'detail_laporan':
            ?>
            <div class="header1" style="background-color: #889CFE; padding: 10px 10px; height: 60px; display: flex;  max-width: 100%; box-sizing: border-box;">
                <h1 style="margin-left: 10px; font-size: 20px; color: #353333; margin-right: 10px; white-space: nowrap;">Detail Pelanggaran Mahasiswa</h1>
            </div><?php
            break;

        case 'dashboard':
            ?>
            <div class="header1" style="background-color: #889CFE; padding: 10px 10px; height: 60px; display: flex;  max-width: 100%; box-sizing: border-box;">
                <h1 style="margin-left: 10px; font-size: 20px; color: #353333; margin-right: 10px; white-space: nowrap;">Profil Mahasiswa</h1>
            </div><?php
            break;
    }
} else if (!isset($_GET['page'])) {
    ?><div class="header1" style="background-color: #889CFE; padding: 10px 10px; height: 60px; display: flex;  max-width: 100%; box-sizing: border-box;">
<h1 style="margin-left: 10px; font-size: 20px; color: #353333; margin-right: 10px; white-space: nowrap;">Dashboard</h1>
</div><?php
}
?>