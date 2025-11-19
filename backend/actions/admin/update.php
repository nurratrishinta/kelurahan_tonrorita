<?php
include '../../app.php';

if (isset($_POST['tombol'])) {
    $id = intval($_GET['id']);
    $username = escapeString($_POST['username']);
    $nama_lengkap = escapeString($_POST['nama_lengkap']);
    $email = escapeString($_POST['email']);
    $password = trim($_POST['password'] ?? '');
    $foto = '';

    // Ambil data lama
    $qOld = mysqli_query($connect, "SELECT foto FROM admin WHERE id = '$id'");
    $old = mysqli_fetch_assoc($qOld);
    $oldFoto = $old['foto'] ?? '';

    // Upload foto baru jika ada
    if (!empty($_FILES['foto']['name'])) {
        $dir = '../../storages/admin/';
        if (!is_dir($dir)) mkdir($dir, 0777, true);
        $fileName = time() . '_' . basename($_FILES['foto']['name']);
        $target = $dir . $fileName;
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target)) {
            // Hapus foto lama jika ada
            if (!empty($oldFoto) && file_exists($dir . $oldFoto)) {
                unlink($dir . $oldFoto);
            }
            $foto = $fileName;
        } else {
            $foto = $oldFoto;
        }
    } else {
        $foto = $oldFoto;
    }

    // Update data admin
    if ($password !== '') {
        $hashPass = password_hash($password, PASSWORD_DEFAULT);
        $qUpdate = "
            UPDATE admin SET
                username = '$username',
                password = '$hashPass',
                nama_lengkap = '$nama_lengkap',
                email = '$email',
                foto = '$foto'
            WHERE id = '$id'
        ";
    } else {
        $qUpdate = "
            UPDATE admin SET
                username = '$username',
                nama_lengkap = '$nama_lengkap',
                email = '$email',
                foto = '$foto'
            WHERE id = '$id'
        ";
    }

    if (mysqli_query($connect, $qUpdate)) {
        echo "
            <script>
                alert('Data admin berhasil diperbarui');
                window.location.href='../../pages/admin/index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Gagal memperbarui data admin: " . mysqli_error($connect) . "');
                window.location.href='../../pages/admin/edit.php?id=$id';
            </script>
        ";
    }
}
?>
