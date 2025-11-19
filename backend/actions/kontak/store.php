<?php
include '../../app.php';

if (isset($_POST['tombol'])) {
    $nama = escapeString($_POST['nama']);
    $email = escapeString($_POST['email']);
    $no_hp = escapeString($_POST['no_hp']);
    $pesan = escapeString($_POST['pesan']);
    $status = escapeString($_POST['status']);

    // Simpan ke database
    $qInsert = "
        INSERT INTO kontak (nama, email, no_hp, pesan, status, created_at)
        VALUES ('$nama', '$email', '$no_hp', '$pesan', '$status', NOW())
    ";

    if (mysqli_query($connect, $qInsert)) {
        echo "
            <script>
                alert('Data kontak berhasil ditambahkan');
                window.location.href='../../pages/kontak/index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Gagal menambahkan data kontak: " . mysqli_error($connect) . "');
                window.location.href='../../pages/kontak/create.php';
            </script>
        ";
    }
}
