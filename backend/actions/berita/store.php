<?php
include '../../app.php';

if (isset($_POST['tombol'])) {
    $judul = escapeString($_POST['judul']);
    $isi = escapeString($_POST['isi']);
    $penulis = escapeString($_POST['penulis']);
    $tanggal = escapeString($_POST['tanggal']);
    $kategori = escapeString($_POST['kategori']);

    // Upload gambar
    $gambar = '';
    if (!empty($_FILES['gambar']['name'])) {
        $dir = '../../storages/berita/';
        if (!is_dir($dir)) mkdir($dir, 0777, true);

        $fileName = time() . "_" . basename($_FILES['gambar']['name']);
        $targetPath = $dir . $fileName;

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $targetPath)) {
            $gambar = $fileName;
        }
    }

    // Simpan ke database
    $qInsert = "
        INSERT INTO berita (judul, isi, gambar, penulis, tanggal, kategori, created_at)
        VALUES ('$judul', '$isi', '$gambar', '$penulis', '$tanggal', '$kategori', NOW())
    ";

    if (mysqli_query($connect, $qInsert)) {
        echo "
            <script>
                alert('Berita berhasil ditambahkan');
                window.location.href='../../pages/berita/index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Gagal menambahkan berita: " . mysqli_error($connect) . "');
                window.location.href='../../pages/berita/create.php';
            </script>
        ";
    }
}
?>
