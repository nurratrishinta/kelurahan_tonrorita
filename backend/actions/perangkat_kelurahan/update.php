<?php
include '../../app.php';

if (isset($_POST['tombol'])) {
    $id = intval($_GET['id']);
    $nama = escapeString($_POST['nama']);
    $jabatan = escapeString($_POST['jabatan']);
    $keterangan = escapeString($_POST['keterangan']);
    $foto = '';

    // Ambil data lama
    $qOld = mysqli_query($connect, "SELECT foto FROM perangkat_kelurahan WHERE id = '$id'");
    $old = mysqli_fetch_assoc($qOld);
    $fotoLama = $old['foto'];

    // Upload foto baru jika ada
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $dir = "../../../storages/perangkat_kelurahan/";
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
        UPDATE perangkat_kelurahan SET 
            nama = '$nama',
            jabatan = '$jabatan',
            foto = '$foto',
            keterangan = '$keterangan'
        WHERE id = '$id'
    ";

    if (mysqli_query($connect, $qUpdate)) {
        echo "
            <script>
                alert('Data perangkat kelurahan berhasil diperbarui');
                window.location.href='../../pages/perangkat_kelurahan/index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Gagal memperbarui data: " . mysqli_error($connect) . "');
                window.location.href='../../pages/perangkat_kelurahan/edit.php?id=$id';
            </script>
        ";
    }
}
?>
