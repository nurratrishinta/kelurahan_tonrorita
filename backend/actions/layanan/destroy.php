<?php
include '../../app.php';
include './show.php';

// Hapus data dari tabel layanan
$qDelete = "DELETE FROM layanan WHERE id = '$layanan->id'";
$result = mysqli_query($connect, $qDelete) or die(mysqli_error($connect));

if ($result) {
    echo "
        <script>
            alert('Data layanan berhasil dihapus');
            window.location.href='../../pages/layanan/index.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Gagal menghapus data layanan');
            window.location.href='../../pages/layanan/index.php';
        </script>
    ";
}
?>
