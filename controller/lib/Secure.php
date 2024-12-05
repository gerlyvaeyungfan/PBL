<?php
/**
 * Fungsi untuk mencegah serangan SQL Injection
 * dengan membersihkan dan memproses input pengguna.
 *
 * @param string $data Input pengguna yang akan diproses.
 * @return string Data yang sudah dibersihkan.
 */
function antiSqlInjection($data) {
    // Menghapus karakter backslash
    $data = stripslashes($data);

    // Menghapus tag HTML
    $data = strip_tags($data);

    // Mengubah karakter spesial menjadi entitas HTML
    $data = htmlentities($data);

    // Menghindari injeksi melalui karakter spesial
    $data = htmlspecialchars($data);

    // Menambahkan backslash sebelum karakter tertentu untuk keamanan
    $data = addslashes($data);

    return $data;
}
