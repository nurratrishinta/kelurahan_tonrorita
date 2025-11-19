<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidenav.php';
include '../../partials/navbar.php';

$id = $_GET['id'] ?? 0;
$qSelect = "SELECT * FROM perangkat_kelurahan WHERE id = ?";
$stmt = mysqli_prepare($connect, $qSelect);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("<script>alert('Data perangkat tidak ditemukan!'); window.location.href='./index.php';</script>");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama']);
    $jabatan = trim($_POST['jabatan']);
    $keterangan = trim($_POST['keterangan']);
    $fileName = $_FILES['foto']['name'] ?? '';
    $finalFoto = $data['foto'];

    if ($fileName) {
        $dir = "../../../storages/perangkat_kelurahan/";
        if (!is_dir($dir)) mkdir($dir, 0777, true);

        $newName = time() . "_" . basename($fileName);
        move_uploaded_file($_FILES['foto']['tmp_name'], $dir . $newName);

        if (!empty($data['foto']) && file_exists($dir . $data['foto'])) {
            unlink($dir . $data['foto']);
        }

        $finalFoto = $newName;
    }

    $qUpdate = "UPDATE perangkat_kelurahan SET nama=?, jabatan=?, foto=?, keterangan=? WHERE id=?";
    $stmt = mysqli_prepare($connect, $qUpdate);
    mysqli_stmt_bind_param($stmt, "ssssi", $nama, $jabatan, $finalFoto, $keterangan, $id);
    mysqli_stmt_execute($stmt);

    echo "<script>alert('Data perangkat berhasil diperbarui!'); window.location.href='./index.php';</script>";
}
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Edit Perangkat Kelurahan</h5>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['nama']) ?>" required>
                </div>

                <div class="mb-3">
                    <label>Jabatan</label>
                    <input type="text" name="jabatan" class="form-control" value="<?= htmlspecialchars($data['jabatan']) ?>" required>
                </div>

                <div class="mb-3">
                    <label>Foto Saat Ini:</label><br>
                    <?php if ($data['foto']): ?>
                        <img src="../../../storages/perangkat_kelurahan/<?= htmlspecialchars($data['foto']) ?>" width="100" class="rounded mb-2">
                    <?php else: ?>
                        <p class="text-muted">Tidak ada foto</p>
                    <?php endif; ?>
                    <input type="file" name="foto" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="5"><?= htmlspecialchars($data['keterangan']) ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="./index.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

<?php
include '../../partials/footer.php';
include '../../partials/script.php';
?>