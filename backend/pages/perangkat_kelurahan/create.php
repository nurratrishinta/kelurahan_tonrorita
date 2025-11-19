<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidenav.php';
include '../../partials/navbar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama']);
    $jabatan = trim($_POST['jabatan']);
    $keterangan = trim($_POST['keterangan']);
    $fileName = $_FILES['foto']['name'] ?? '';

    $finalFoto = '';
    if ($fileName) {
        $dir = "../../../storages/perangkat_kelurahan/";
        if (!is_dir($dir)) mkdir($dir, 0777, true);

        $newName = time() . "_" . basename($fileName);
        move_uploaded_file($_FILES['foto']['tmp_name'], $dir . $newName);
        $finalFoto = $newName;
    }

    $qInsert = "INSERT INTO perangkat_kelurahan (nama, jabatan, foto, keterangan, created_at)
                VALUES (?, ?, ?, ?, NOW())";
    $stmt = mysqli_prepare($connect, $qInsert);
    mysqli_stmt_bind_param($stmt, "ssss", $nama, $jabatan, $finalFoto, $keterangan);
    mysqli_stmt_execute($stmt);

    echo "<script>alert('Perangkat kelurahan berhasil ditambahkan'); window.location.href='./index.php';</script>";
}
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Tambah Perangkat Kelurahan</h5>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Jabatan</label>
                    <input type="text" name="jabatan" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Foto</label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                </div>

                <div class="mb-3">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="5"></textarea>
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="./index.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

<?php
include '../../partials/footer.php';
include '../../partials/script.php';
?>