<?php
include '../../app.php';

if (isset($_POST['tombol'])) {
    $username = escapeString($_POST['username']);
    $password = password_hash(escapeString($_POST['password']), PASSWORD_DEFAULT);
    $nama_lengkap = escapeString($_POST['nama_lengkap']);
    $email = escapeString($_POST['email']);
    $foto = '';

    // Upload foto jika ada
    if (!empty($_FILES['foto']['name'])) {
        $dir = '../../storages/admin/';
        if (!is_dir($dir)) mkdir($dir, 0777, true);
        $fileName = time() . '_' . basename($_FILES['foto']['name']);
        $target = $dir . $fileName;
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target)) {
            $foto = $fileName;
        }
    }

    // Insert ke database
    $qInsert = "
        INSERT INTO admin (username, password, nama_lengkap, email, foto, created_at)
        VALUES ('$username', '$password', '$nama_lengkap', '$email', '$foto', NOW())
    ";

    if (mysqli_query($connect, $qInsert)) {
        echo "
            <script>
                alert('Admin baru berhasil ditambahkan');
                window.location.href='../../pages/admin/index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Gagal menambahkan admin: " . mysqli_error($connect) . "');
                window.location.href='../../pages/admin/create.php';
            </script>
        ";
    }
}
?>
