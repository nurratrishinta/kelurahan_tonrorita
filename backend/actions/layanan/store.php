<?php
include '../../app.php';

if (isset($_POST['tombol'])) {
    $nama_layanan = escapeString($_POST['nama_layanan']);
    $deskripsi = escapeString($_POST['deskripsi']);
    $syarat = escapeString($_POST['syarat']);
    $biaya = escapeString($_POST['biaya']);
    $waktu_proses = escapeString($_POST['waktu_proses']);

    // Simpan ke database
    $qInsert = "
        INSERT INTO layanan (nama_layanan, deskripsi, syarat, biaya, waktu_proses, created_at)
        VALUES ('$nama_layanan', '$deskripsi', '$syarat', '$biaya', '$waktu_proses', NOW())
    ";

    if (mysqli_query($connect, $qInsert)) {
        echo "
            <script>
                alert('Data layanan berhasil ditambahkan');
                window.location.href='../../pages/layanan/index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Gagal menambahkan data layanan: " . mysqli_error($connect) . "');
                window.location.href='../../pages/layanan/create.php';
            </script>
        ";
    }
}
?>
