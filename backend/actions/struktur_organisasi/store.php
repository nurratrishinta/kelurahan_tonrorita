<?php
include '../../app.php';

if (isset($_POST['tombol'])) {
    $nama = escapeString($_POST['nama']);
    $jabatan = escapeString($_POST['jabatan']);
    $parent_id = isset($_POST['parent_id']) && $_POST['parent_id'] !== '' ? intval($_POST['parent_id']) : 'NULL';
    $foto = '';

    // Upload foto
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $dir = "../../../storages/struktur_organisasi/";
        if (!is_dir($dir)) mkdir($dir, 0777, true);

        $foto = time() . "_" . basename($_FILES['foto']['name']);
        move_uploaded_file($_FILES['foto']['tmp_name'], $dir . $foto);
    }

    // Simpan ke database
    $qInsert = "
        INSERT INTO struktur_organisasi (nama, jabatan, foto, parent_id)
        VALUES ('$nama', '$jabatan', '$foto', $parent_id)
    ";

    if (mysqli_query($connect, $qInsert)) {
        echo "
            <script>
                alert('Data struktur organisasi berhasil ditambahkan');
                window.location.href='../../pages/struktur_organisasi/index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Gagal menambahkan data: " . mysqli_error($connect) . "');
                window.location.href='../../pages/struktur_organisasi/create.php';
            </script>
        ";
    }
}
?>
