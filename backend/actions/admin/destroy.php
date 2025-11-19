<?php
include '../../app.php';
include './show.php';

// Hapus foto jika ada
if (!empty($admin->foto) && file_exists("../../storages/admin/" . $admin->foto)) {
    unlink("../../storages/admin/" . $admin->foto);
}

// Hapus data dari tabel admin
$qDelete = "DELETE FROM admin WHERE id = '$admin->id'";
$result = mysqli_query($connect, $qDelete) or die(mysqli_error($connect));

if ($result) {
    echo "
        <script>
            alert('Data admin berhasil dihapus');
            window.location.href='../../pages/admin/index.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Gagal menghapus data admin');
            window.location.href='../../pages/admin/index.php';
        </script>
    ";
}
?>
