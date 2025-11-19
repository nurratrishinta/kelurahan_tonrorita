<?php
include '../../app.php';

if (isset($_POST['tombol'])) {
    $nama_kelurahan = escapeString($_POST['nama_kelurahan']);
    $visi = escapeString($_POST['visi']);
    $misi = escapeString($_POST['misi']);
    $sejarah = escapeString($_POST['sejarah']);
    $alamat = escapeString($_POST['alamat']);
    $telepon = escapeString($_POST['telepon']);
    $email = escapeString($_POST['email']);

    // Upload logo
    $logoName = '';
    if (!empty($_FILES['logo']['tmp_name'])) {
        $logoTmp = $_FILES['logo']['tmp_name'];
        $logoName = uniqid() . "_logo.png";
        $logoPath = "../../../storages/logo/" . $logoName;
        move_uploaded_file($logoTmp, $logoPath);
    }

    // Simpan ke database
    $qInsert = "INSERT INTO profil_kelurahan 
        (nama_kelurahan, visi, misi, sejarah, alamat, telepon, email, logo, created_at, updated_at)
        VALUES 
        ('$nama_kelurahan', '$visi', '$misi', '$sejarah', '$alamat', '$telepon', '$email', '$logoName', NOW(), NOW())";

    $result = mysqli_query($connect, $qInsert) or die(mysqli_error($connect));

    if ($result) {
        echo "
            <script>
                alert('Data Profil Kelurahan berhasil ditambahkan');
                window.location.href='../../pages/profil_kelurahan/index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Gagal menambahkan data');
                window.location.href='../../pages/profil_kelurahan/create.php';
            </script>
        ";
    }
}
?>
