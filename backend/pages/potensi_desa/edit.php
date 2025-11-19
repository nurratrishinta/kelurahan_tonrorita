<?php
include '../../../config/connection.php';
include '../../partials/header.php';
include '../../partials/sidenav.php';
include '../../partials/navbar.php';

$id = $_GET['id'] ?? 0;
$qSelect = "SELECT * FROM potensi_desa WHERE id = ?";
$stmt = mysqli_prepare($connect, $qSelect);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("<script>alert('Data potensi desa tidak ditemukan!'); window.location.href='./index.php';</script>");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kategori = trim($_POST['kategori']);
    $judul = trim($_POST['judul']);
    $deskripsi = trim($_POST['deskripsi']);
    $fileName = $_FILES['gambar']['name'] ?? '';
    $finalGambar = $data['gambar'];

    if ($fileName) {
        $dir = "../../../storages/potensi_desa/";
        if (!is_dir($dir)) mkdir($dir, 0777, true);

        $newName = time() . "_" . basename($fileName);
        move_uploaded_file($_FILES['gambar']['tmp_name'], $dir . $newName);

        if (!empty($data['gambar']) && file_exists($dir . $data['gambar'])) {
            unlink($dir . $data['gambar']);
        }

        $finalGambar = $newName;
    }

    $qUpdate = "UPDATE potensi_desa SET kategori=?, judul=?, deskripsi=?, gambar=? WHERE id=?";
    $stmt = mysqli_prepare($connect, $qUpdate);
    mysqli_stmt_bind_param($stmt, "ssssi", $kategori, $judul, $deskripsi, $finalGambar, $id);
    mysqli_stmt_execute($stmt);

    echo "<script>alert('Data potensi desa berhasil diperbarui!'); window.location.href='./index.php';</script>";
}
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Edit Potensi Desa</h5>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label>Kategori</label>
                    <input type="text" name="kategori" class="form-control" value="<?= htmlspecialchars($data['kategori']) ?>" required>
                </div>

                <div class="mb-3">
                    <label>Judul</label>
                    <input type="text" name="judul" class="form-control" value="<?= htmlspecialchars($data['judul']) ?>" required>
                </div>

                <div class="mb-3">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="6" required><?= htmlspecialchars($data['deskripsi']) ?></textarea>
                </div>

                <div class="mb-3">
                    <label>Gambar Saat Ini:</label><br>
                    <?php if ($data['gambar']): ?>
                        <img src="../../../storages/potensi_desa/<?= htmlspecialchars($data['gambar']) ?>" width="100" class="rounded mb-2">
                    <?php else: ?>
                        <p class="text-muted">Tidak ada gambar</p>
                    <?php endif; ?>
                    <input type="file" name="gambar" class="form-control">
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