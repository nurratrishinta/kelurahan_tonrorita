<?php
include '../../app.php';
include './show.php';

// Hapus file foto jika ada
if ($struktur->foto && file_exists("../../../storages/struktur_organisasi/$struktur->foto")) {
    unlink("../../../storages/struktur_organisasi/$struktur->foto");
}

// Hapus data dari tabel struktur_organisasi
$qDelete = "DELETE FROM struktur_organisasi WHERE id = '$struktur->id'";
$result = mysqli_query($connect, $qDelete) or die(mysqli_error($connect));

if ($result) {
    echo "
        <script>
            alert('Data struktur organisasi berhasil dihapus');
            window.location.href='../../pages/struktur_organisasi/index.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Gagal menghapus data struktur organisasi');
            window.location.href='../../pages/struktur_organisasi/index.php';
        </script>
    ";
}
?>
