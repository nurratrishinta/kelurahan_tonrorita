<?php
include '../../app.php';
include './show.php';

// Hapus gambar jika ada
$dir = '../../storages/berita/';
if (!empty($berita->gambar) && file_exists($dir . $berita->gambar)) {
    unlink($dir . $berita->gambar);
}

// Hapus data dari tabel berita
$qDelete = "DELETE FROM berita WHERE id = '$berita->id'";
$result = mysqli_query($connect, $qDelete) or die(mysqli_error($connect));

if ($result) {
    echo "
        <script>
            alert('Berita berhasil dihapus');
            window.location.href='../../pages/berita/index.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Gagal menghapus berita');
            window.location.href='../../pages/berita/index.php';
        </script>
    ";
}
?>
