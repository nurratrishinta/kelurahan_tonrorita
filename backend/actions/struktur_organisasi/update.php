<?php
include '../../app.php';

if (isset($_POST['tombol'])) {
    $id = intval($_GET['id']);
    $nama = escapeString($_POST['nama']);
    $jabatan = escapeString($_POST['jabatan']);
    $parent_id = isset($_POST['parent_id']) && $_POST['parent_id'] !== '' ? intval($_POST['parent_id']) : 'NULL';
    $foto = '';

    // Cek foto lama
    $qOld = mysqli_query($connect, "SELECT foto FROM struktur_organisasi WHERE id = '$id'");
    $old = mysqli_fetch_assoc($qOld);
    $fotoLama = $old['foto'];

    // Upload foto baru jika ada
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $dir = "../../../storages/struktur_organisasi/";
        if (!is_dir($dir)) mkdir($dir, 0777, true);

        $foto = time() . "_" . basename($_FILES['foto']['name']);
        move_uploaded_file($_FILES['foto']['tmp_name'], $dir . $foto);

        // Hapus foto lama
        if ($fotoLama && file_exists($dir . $fotoLama)) {
            unlink($dir . $fotoLama);
        }
    } else {
        $foto = $fotoLama;
    }

    // Update data
    $qUpdate = "
        UPDATE struktur_organisasi SET 
            nama = '$nama',
            jabatan = '$jabatan',
            foto = '$foto',
            parent_id = $parent_id
        WHERE id = '$id'
    ";

    if (mysqli_query($connect, $qUpdate)) {
        echo "
            <script>
                alert('Data struktur organisasi berhasil diperbarui');
                window.location.href='../../pages/struktur_organisasi/index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Gagal memperbarui data: " . mysqli_error($connect) . "');
                window.location.href='../../pages/struktur_organisasi/edit.php?id=$id';
            </script>
        ";
    }
}
?>
