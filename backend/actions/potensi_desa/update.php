<?php
include '../../app.php';

if (isset($_POST['tombol'])) {
    $id = intval($_GET['id']);
    $kategori = escapeString($_POST['kategori']);
    $judul = escapeString($_POST['judul']);
    $deskripsi = escapeString($_POST['deskripsi']);

    // Upload gambar baru jika ada
    $gambar = '';
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $dir = "../../../storages/potensi_desa/";
        if (!is_dir($dir)) mkdir($dir, 0777, true);

        $gambar = time() . "_" . basename($_FILES['gambar']['name']);
        move_uploaded_file($_FILES['gambar']['tmp_name'], $dir . $gambar);
    }

    // Ambil gambar lama (jika tidak upload baru)
    $qOld = mysqli_query($connect, "SELECT gambar FROM potensi_desa WHERE id = '$id'");
    $old = mysqli_fetch_assoc($qOld);
    $gambarLama = $old['gambar'];

    if ($gambar == '') $gambar = $gambarLama;
    else if ($gambarLama && file_exists("../../../storages/potensi_desa/$gambarLama")) unlink("../../../storages/potensi_desa/$gambarLama");

    // Update data potensi desa
    $qUpdate = "
        UPDATE potensi_desa SET 
            kategori = '$kategori',
            judul = '$judul',
            deskripsi = '$deskripsi',
            gambar = '$gambar'
        WHERE id = '$id'
    ";

    if (mysqli_query($connect, $qUpdate)) {
        echo "
            <script>
                alert('Data potensi desa berhasil diperbarui');
                window.location.href='../../pages/potensi_desa/index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Gagal memperbarui data: " . mysqli_error($connect) . "');
                window.location.href='../../pages/potensi_desa/edit.php?id=$id';
            </script>
        ";
    }
}
?>
