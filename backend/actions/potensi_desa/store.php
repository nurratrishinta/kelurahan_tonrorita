<?php
include '../../app.php';

if (isset($_POST['tombol'])) {
    $kategori = escapeString($_POST['kategori']);
    $judul = escapeString($_POST['judul']);
    $deskripsi = escapeString($_POST['deskripsi']);
    $gambar = '';

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $dir = "../../../storages/potensi_desa/";
        if (!is_dir($dir)) mkdir($dir, 0777, true);

        $gambar = time() . "_" . basename($_FILES['gambar']['name']);
        move_uploaded_file($_FILES['gambar']['tmp_name'], $dir . $gambar);
    }

    // Simpan ke database
    $qInsert = "
        INSERT INTO potensi_desa (kategori, judul, deskripsi, gambar, created_at)
        VALUES ('$kategori', '$judul', '$deskripsi', '$gambar', NOW())
    ";

    if (mysqli_query($connect, $qInsert)) {
        echo "
            <script>
                alert('Data potensi desa berhasil ditambahkan');
                window.location.href='../../pages/potensi_desa/index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Gagal menambahkan data potensi desa: " . mysqli_error($connect) . "');
                window.location.href='../../pages/potensi_desa/create.php';
            </script>
        ";
    }
}
?>
