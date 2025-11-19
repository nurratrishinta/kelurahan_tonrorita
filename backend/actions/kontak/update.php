<?php
include '../../app.php';

if (isset($_POST['tombol'])) {
    $id = intval($_GET['id']);
    $nama = escapeString($_POST['nama']);
    $email = escapeString($_POST['email']);
    $no_hp = escapeString($_POST['no_hp']);
    $pesan = escapeString($_POST['pesan']);
    $status = escapeString($_POST['status']);

    // Update data kontak
    $qUpdate = "
        UPDATE kontak SET 
            nama = '$nama',
            email = '$email',
            no_hp = '$no_hp',
            pesan = '$pesan',
            status = '$status'
        WHERE id = '$id'
    ";

    if (mysqli_query($connect, $qUpdate)) {
        echo "
            <script>
                alert('Data kontak berhasil diperbarui');
                window.location.href='../../pages/kontak/index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Gagal memperbarui data kontak: " . mysqli_error($connect) . "');
                window.location.href='../../pages/kontak/edit.php?id=$id';
            </script>
        ";
    }
}
?>
