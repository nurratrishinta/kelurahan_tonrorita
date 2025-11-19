<?php
include '../../app.php';
include './show.php';

$storages = "../../../storages/logo/";

// hapus logo lama jika ada
if (!empty($profil->logo) && file_exists($storages . $profil->logo)) {
    unlink($storages . $profil->logo);
}

// hapus data
$qDelete = "DELETE FROM profil_kelurahan WHERE id = '$profil->id'";
$result = mysqli_query($connect, $qDelete) or die(mysqli_error($connect));

// cek apakah data berhasil dihapus
if ($result) {
    echo "
        <script>
            alert('Data Profil Kelurahan berhasil dihapus');
            window.location.href='../../pages/profil_kelurahan/index.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Data gagal dihapus');
            window.location.href='../../pages/profil_kelurahan/index.php';
        </script>
    ";
}
?>
