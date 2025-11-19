<?php
include '../../app.php';

if (isset($_POST['tombol'])) {
    $id = intval($_GET['id']);
    $judul = escapeString($_POST['judul']);
    $isi = escapeString($_POST['isi']);
    $penulis = escapeString($_POST['penulis']);
    $tanggal = escapeString($_POST['tanggal']);
    $kategori = escapeString($_POST['kategori']);

    // Ambil data lama
    $qSelect = "SELECT * FROM berita WHERE id = '$id'";
    $result = mysqli_query($connect, $qSelect);
    $old = mysqli_fetch_assoc($result);

    if (!$old) {
        echo "
            <script>
                alert('Data berita tidak ditemukan');
                window.location.href='../../pages/berita/index.php';
            </script>
        ";
        exit;
    }

    $gambar = $old['gambar'];

    // Upload gambar baru
    if (!empty($_FILES['gambar']['name'])) {
        $dir = '../../storages/berita/';
        if (!is_dir($dir)) mkdir($dir, 0777, true);

        $fileName = time() . "_" . basename($_FILES['gambar']['name']);
        $targetPath = $dir . $fileName;

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $targetPath)) {
            // hapus gambar lama
            if (!empty($old['gambar']) && file_exists($dir . $old['gambar'])) {
                unlink($dir . $old['gambar']);
            }
            $gambar = $fileName;
        }
    }

    // Update data
    $qUpdate = "
        UPDATE berita SET 
            judul = '$judul',
            isi = '$isi',
            gambar = '$gambar',
            penulis = '$penulis',
            tanggal = '$tanggal',
            kategori = '$kategori'
        WHERE id = '$id'
    ";

    if (mysqli_query($connect, $qUpdate)) {
        echo "
            <script>
                alert('Berita berhasil diperbarui');
                window.location.href='../../pages/berita/index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Gagal memperbarui berita: " . mysqli_error($connect) . "');
                window.location.href='../../pages/berita/edit.php?id=$id';
            </script>
        ";
    }
}
?>
