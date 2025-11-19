<?php
include '../../app.php';
include './show.php';

// Hapus file gambar jika ada
if ($potensi_desa->gambar && file_exists("../../../storages/potensi_desa/$potensi_desa->gambar")) {
    unlink("../../../storages/potensi_desa/$potensi_desa->gambar");
}

// Hapus data dari tabel potensi_desa
$qDelete = "DELETE FROM potensi_desa WHERE id = '$potensi_desa->id'";
$result = mysqli_query($connect, $qDelete) or die(mysqli_error($connect));

if ($result) {
    echo "
        <script>
            alert('Data potensi desa berhasil dihapus');
            window.location.href='../../pages/potensi_desa/index.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Gagal menghapus data potensi desa');
            window.location.href='../../pages/potensi_desa/index.php';
        </script>
    ";
}
?>
