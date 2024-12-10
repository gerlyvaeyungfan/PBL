<?php
// Logika untuk memuat konten sesuai dengan parameter "page"
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        case 'pelanggaran':
            ?>
            <div class="header1" style="background-color: #889CFE; padding: 10px 10px; height: 60px; display: flex; align-items: center; max-width: 100%; box-sizing: border-box;">
                <h1 style="margin-left: 10px; font-size: 20px; color: #353333; margin-right: 10px; white-space: nowrap;">Daftar Pelanggaran Mahasiswa</h1>
            </div><?php
            break;

        case 'dashboard':
            ?>
            <div class="header1" style="background-color: #889CFE; padding: 10px 10px; height: 60px; display: flex; align-items: center; max-width: 100%; box-sizing: border-box;">
                <h1 style="margin-left: 10px; font-size: 20px; color: #353333; margin-right: 10px; white-space: nowrap;">Dashboard</h1>
            </div><?php
            break;
    }
} else if (!isset($_GET['page'])) {
    ?><div class="header1" style="background-color: #889CFE; padding: 10px 10px; height: 60px; display: flex; align-items: center; max-width: 100%; box-sizing: border-box;">
<h1 style="margin-left: 10px; font-size: 20px; color: #353333; margin-right: 10px; white-space: nowrap;">Dashboard</h1>
</div><?php
}
?>