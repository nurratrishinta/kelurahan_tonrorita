<?php
include '../../app.php';

if (isset($_POST['tombol'])) {
    $id = intval($_GET['id']);
    $judul = escapeString($_POST['judul']);
    $deskripsi = escapeString($_POST['deskripsi']);
    $kategori = escapeString($_POST['kategori']);

    // Ambil data lama
    $queryOld = mysqli_query($connect, "SELECT * FROM galeri WHERE id='$id'") or die(mysqli_error($connect));
    $dataOld = mysqli_fetch_assoc($queryOld);
    $gambarName = $dataOld['gambar'];

    // Upload gambar baru
    if (!empty($_FILES['gambar']['tmp_name'])) {
        $gambarTmp = $_FILES['gambar']['tmp_name'];
        $gambarName = uniqid() . "_" . basename($_FILES['gambar']['name']);
        $gambarPath = "../../../storages/galeri/" . $gambarName;

        if (!is_dir("../../../storages/galeri")) {
            mkdir("../../../storages/galeri", 0777, true);
        }

        move_uploaded_file($gambarTmp, $gambarPath);

        // hapus gambar lama
        $oldPath = "../../../storages/galeri/" . $dataOld['gambar'];
        if (file_exists($oldPath)) {
            unlink($oldPath);
        }
    }

    // Update data galeri
    $qUpdate = "
        UPDATE galeri SET 
            judul = '$judul',
            gambar = '$gambarName',
            deskripsi = '$deskripsi',
            kategori = '$kategori'
        WHERE id = '$id'
    ";

    if (mysqli_query($connect, $qUpdate)) {
        echo "
            <script>
                alert('Data galeri berhasil diperbarui');
                window.location.href='../../pages/galeri/index.php';
            </script>
        ";
    } else {
        echo "Error update: " . mysqli_error($connect);
    }
}
?>
