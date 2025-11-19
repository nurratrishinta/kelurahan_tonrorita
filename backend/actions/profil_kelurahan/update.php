<?php
include '../../app.php';

if (isset($_POST['tombol'])) {
    $id = intval($_GET['id']);
    $nama_kelurahan = escapeString($_POST['nama_kelurahan']);
    $visi = escapeString($_POST['visi']);
    $misi = escapeString($_POST['misi']);
    $sejarah = escapeString($_POST['sejarah']);
    $alamat = escapeString($_POST['alamat']);
    $telepon = escapeString($_POST['telepon']);
    $email = escapeString($_POST['email']);

    // Ambil data lama
    $queryOld = mysqli_query($connect, "SELECT * FROM profil_kelurahan WHERE id='$id'") or die(mysqli_error($connect));
    $dataOld = mysqli_fetch_assoc($queryOld);

    $logoName = $dataOld['logo'];

    // Jika upload logo baru
    if (!empty($_FILES['logo']['tmp_name'])) {
        $logoTmp = $_FILES['logo']['tmp_name'];
        $logoName = uniqid() . "_logo.png";
        $logoPath = "../../../storages/logo/" . $logoName;
        move_uploaded_file($logoTmp, $logoPath);

        // Hapus logo lama
        $oldPath = "../../../storages/logo/" . $dataOld['logo'];
        if (file_exists($oldPath)) {
            unlink($oldPath);
        }
    }

    // Update data
    $qUpdate = "UPDATE profil_kelurahan SET 
                    nama_kelurahan='$nama_kelurahan',
                    visi='$visi',
                    misi='$misi',
                    sejarah='$sejarah',
                    alamat='$alamat',
                    telepon='$telepon',
                    email='$email',
                    logo='$logoName',
                    updated_at=NOW()
                WHERE id='$id'";

    mysqli_query($connect, $qUpdate) or die(mysqli_error($connect));

    echo "
        <script>
            alert('Data Profil Kelurahan berhasil diperbarui');
            window.location.href='../../pages/profil_kelurahan/index.php';
        </script>
    ";
}
?>
