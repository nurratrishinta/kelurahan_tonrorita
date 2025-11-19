<?php
include '../../app.php';

if (isset($_POST['tombol'])) {
    $id = intval($_GET['id']);
    $nama_layanan = escapeString($_POST['nama_layanan']);
    $deskripsi = escapeString($_POST['deskripsi']);
    $syarat = escapeString($_POST['syarat']);
    $biaya = escapeString($_POST['biaya']);
    $waktu_proses = escapeString($_POST['waktu_proses']);

    // Update data layanan
    $qUpdate = "
        UPDATE layanan SET 
            nama_layanan = '$nama_layanan',
            deskripsi = '$deskripsi',
            syarat = '$syarat',
            biaya = '$biaya',
            waktu_proses = '$waktu_proses'
        WHERE id = '$id'
    ";

    if (mysqli_query($connect, $qUpdate)) {
        echo "
            <script>
                alert('Data layanan berhasil diperbarui');
                window.location.href='../../pages/layanan/index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Gagal memperbarui data layanan: " . mysqli_error($connect) . "');
                window.location.href='../../pages/layanan/edit.php?id=$id';
            </script>
        ";
    }
}
?>
