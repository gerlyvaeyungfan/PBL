<style>
    h2 {
        margin-top: 0px;
    }
</style>
<?php 
    // Menampilkan data menggunakan foreach
    echo '<h2>Daftar Data Dosen</h2>';
    echo '<table border="1" cellpadding="10" cellspacing="0">';
    echo '<tr>
    <th>Nama</th>
    <th>NIDN</th>
    <th>Jenis Kelamin</th>
    <th>Alamat</th>
    <th>Email</th>
    <th>Foto Dosen</th>
    </tr>';

    foreach ($dosen as $data) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($data['nama']) . '</td>';
        echo '<td>' . htmlspecialchars($data['nidn']) . '</td>';
        echo '<td>' . htmlspecialchars($data['jk']) . '</td>';
        echo '<td>' . htmlspecialchars($data['alamat']) . '</td>';
        echo '<td>' . htmlspecialchars($data['email']) . '</td>';
        // Menampilkan gambar
        echo '<td><img src="' . htmlspecialchars($data['foto_dosen']) . '" alt="Foto Dosen" style="width:100px; height:auto;"></td>';

        echo '</tr>';
    }
    echo '</table>';
?>               