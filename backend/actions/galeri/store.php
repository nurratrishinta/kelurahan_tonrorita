<?php
include '../../app.php';

if (isset($_POST['tombol'])) {
    $judul = escapeString($_POST['judul']);
    $deskripsi = escapeString($_POST['deskripsi']);
    $kategori = escapeString($_POST['kategori']);

    // Upload gambar
    $gambarName = '';
    if (!empty($_FILES['gambar']['tmp_name'])) {
        $gambarTmp = $_FILES['gambar']['tmp_name'];
        $gambarName = uniqid() . "_" . basename($_FILES['gambar']['name']);
        $gambarPath = "../../../storages/galeri/" . $gambarName;

        if (!is_dir("../../../storages/galeri")) {
            mkdir("../../../storages/galeri", 0777, true);
        }

        move_uploaded_file($gambarTmp, $gambarPath);
    }

    // Simpan ke database
    $qInsert = "
        INSERT INTO galeri (judul, gambar, deskripsi, kategori, created_at)
        VALUES ('$judul', '$gambarName', '$deskripsi', '$kategori', NOW())
    ";

    if (mysqli_query($connect, $qInsert)) {
        echo "
            <script>
                alert('Data galeri berhasil ditambahkan');
                window.location.href='../../pages/galeri/index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Gagal menambahkan data galeri: " . mysqli_error($connect) . "');
                window.location.href='../../pages/galeri/create.php';
            </script>
        ";
    }
}
?>
