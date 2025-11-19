<?php
include '../../app.php';

if (isset($_POST['tombol'])) {
    $nama_platform = escapeString($_POST['nama_platform']);
    $link = escapeString($_POST['link']);
    $icon = escapeString($_POST['icon']);

    // Simpan ke database
    $qInsert = "
        INSERT INTO sosial_media (nama_platform, link, icon, created_at)
        VALUES ('$nama_platform', '$link', '$icon', NOW())
    ";

    if (mysqli_query($connect, $qInsert)) {
        echo "
            <script>
                alert('Data sosial media berhasil ditambahkan');
                window.location.href='../../pages/sosial_media/index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Gagal menambahkan data sosial media: " . mysqli_error($connect) . "');
                window.location.href='../../pages/sosial_media/create.php';
            </script>
        ";
    }
}
?>
