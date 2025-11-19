<?php
include '../../app.php';
include './show.php';

$storages = "../../../storages/galeri/";

// hapus file gambar lama jika ada
if (!empty($galeri->gambar) && file_exists($storages . $galeri->gambar)) {
    unlink($storages . $galeri->gambar);
}

// hapus data dari tabel
$qDelete = "DELETE FROM galeri WHERE id = '$galeri->id'";
$result = mysqli_query($connect, $qDelete) or die(mysqli_error($connect));

if ($result) {
    echo "
        <script>
            alert('Data galeri berhasil dihapus');
            window.location.href='../../pages/galeri/index.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Gagal menghapus data galeri');
            window.location.href='../../pages/galeri/index.php';
        </script>
    ";
}
?>
