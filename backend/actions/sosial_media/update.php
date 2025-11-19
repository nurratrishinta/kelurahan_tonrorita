<?php
include '../../app.php';

if (isset($_POST['tombol'])) {
    $id = intval($_GET['id']);
    $nama_platform = escapeString($_POST['nama_platform']);
    $link = escapeString($_POST['link']);
    $icon = escapeString($_POST['icon']);

    // Update data sosial media
    $qUpdate = "
        UPDATE sosial_media SET 
            nama_platform = '$nama_platform',
            link = '$link',
            icon = '$icon'
        WHERE id = '$id'
    ";

    if (mysqli_query($connect, $qUpdate)) {
        echo "
            <script>
                alert('Data sosial media berhasil diperbarui');
                window.location.href='../../pages/sosial_media/index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Gagal memperbarui data: " . mysqli_error($connect) . "');
                window.location.href='../../pages/sosial_media/edit.php?id=$id';
            </script>
        ";
    }
}
?>
