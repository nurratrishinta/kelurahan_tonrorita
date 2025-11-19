<?php
include '../../app.php';
include './show.php';

// Hapus data dari tabel kontak
$qDelete = "DELETE FROM kontak WHERE id = '$kontak->id'";
$result = mysqli_query($connect, $qDelete) or die(mysqli_error($connect));

if ($result) {
    echo "
        <script>
            alert('Data kontak berhasil dihapus');
            window.location.href='../../pages/kontak/index.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Gagal menghapus data kontak');
            window.location.href='../../pages/kontak/index.php';
        </script>
    ";
}
?>
