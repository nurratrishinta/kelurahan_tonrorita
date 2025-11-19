<?php
include '../../app.php';

if (isset($_POST['tombol'])) {
    $nama = escapeString($_POST['nama']);
    $jabatan = escapeString($_POST['jabatan']);
    $keterangan = escapeString($_POST['keterangan']);
    $foto = '';

    // Upload foto jika ada
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $dir = "../../../storages/perangkat_kelurahan/";
        if (!is_dir($dir)) mkdir($dir, 0777, true);

        $foto = time() . "_" . basename($_FILES['foto']['name']);
        move_uploaded_file($_FILES['foto']['tmp_name'], $dir . $foto);
    }

    // Simpan ke database
    $qInsert = "
        INSERT INTO perangkat_kelurahan (nama, jabatan, foto, keterangan, created_at)
        VALUES ('$nama', '$jabatan', '$foto', '$keterangan', NOW())
    ";

    if (mysqli_query($connect, $qInsert)) {
        echo "
            <script>
                alert('Data perangkat kelurahan berhasil ditambahkan');
                window.location.href='../../pages/perangkat_kelurahan/index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Gagal menambahkan data: " . mysqli_error($connect) . "');
                window.location.href='../../pages/perangkat_kelurahan/create.php';
            </script>
        ";
    }
}
?>
