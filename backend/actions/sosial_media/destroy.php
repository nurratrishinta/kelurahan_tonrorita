<?php
include '../../app.php';
include './show.php';

// Hapus data dari tabel sosial media
$qDelete = "DELETE FROM sosial_media WHERE id = '$sosial_media->id'";
$result = mysqli_query($connect, $qDelete) or die(mysqli_error($connect));

if ($result) {
    echo "
        <script>
            alert('Data sosial media berhasil dihapus');
            window.location.href='../../pages/sosial_media/index.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Gagal menghapus data sosial media');
            window.location.href='../../pages/sosial_media/index.php';
        </script>
    ";
}
?>
