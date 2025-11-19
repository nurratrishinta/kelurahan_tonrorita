<?php
include '../../app.php';
include './show.php';

// Hapus file foto jika ada
if ($perangkat->foto && file_exists("../../../storages/perangkat_kelurahan/$perangkat->foto")) {
    unlink("../../../storages/perangkat_kelurahan/$perangkat->foto");
}

// Hapus data dari tabel perangkat_kelurahan
$qDelete = "DELETE FROM perangkat_kelurahan WHERE id = '$perangkat->id'";
$result = mysqli_query($connect, $qDelete) or die(mysqli_error($connect));

if ($result) {
    echo "
        <script>
            alert('Data perangkat kelurahan berhasil dihapus');
            window.location.href='../../pages/perangkat_kelurahan/index.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Gagal menghapus data perangkat kelurahan');
            window.location.href='../../pages/perangkat_kelurahan/index.php';
        </script>
    ";
}
?>
